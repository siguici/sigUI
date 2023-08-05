import { PluginContract } from "./contracts/plugin";
import type {
    ClassName,
    ComponentList,
    DarkMode,
    DeclarationBlock,
    PropertyName,
    PropertyValue,
    RuleSet,
    StyleCallback,
    StyleCallbacks,
    StyleValues,
    UtilityList,
    UtilityName,
} from "./types";
import { DarkModeConfig, PluginAPI } from "tailwindcss/types/config";

export abstract class Plugin<T> implements PluginContract<T> {
    readonly darkMode: DarkMode = ["media", "prefers-color-scheme: dark"];
    abstract readonly components: ComponentList;
    abstract readonly utilities: UtilityList;

    constructor(readonly api: PluginAPI, readonly options: T) {
        const { config } = api;
        const configDarkMode: Partial<DarkModeConfig> | undefined =
            config().darkMode;

        if (configDarkMode !== undefined) {
            const mediaQuery = "prefers-color-scheme: dark";
            const classQuery = ".dark";

            if (configDarkMode === "media" || configDarkMode === "class") {
                this.darkMode = [
                    configDarkMode,
                    configDarkMode === "media" ? mediaQuery : classQuery,
                ];
            } else if (configDarkMode[0] !== undefined) {
                this.darkMode = [configDarkMode[0], classQuery];
            }
        }
    }

    abstract create(): this;

    protected getPropertyOf(utility: UtilityName): PropertyName {
        return this.utilities[utility];
    }

    protected getPropertiesOf(utilities: UtilityName[]): PropertyName[] {
        const properties: PropertyName[] = [];
        utilities.forEach((utility) => {
            properties.push(this.getPropertyOf(utility));
        });
        return properties;
    }

    protected darken(
        className: string,
        lightRules: RuleSet,
        darkRules: RuleSet | undefined = undefined,
    ): RuleSet {
        const rules: RuleSet = {};
        const { e } = this.api;

        if (darkRules !== undefined) {
            if (this.darkMode[0] === "media") {
                rules[`.${e(className)}`] = {
                    ...lightRules,
                    [`@media (${this.darkMode[1]})`]: {
                        ["&"]: {
                            ...darkRules,
                        },
                    },
                };
            } else {
                rules[`.${e(className)}`] = {
                    ...lightRules,
                    [`:is(${this.darkMode[1]} &)`]: {
                        ...darkRules,
                    },
                };
            }
        } else {
            rules[`.${e(className)}`] = lightRules;
        }

        return rules;
    }

    protected stylizeClass(
        className: ClassName,
        properties: DeclarationBlock,
    ): RuleSet {
        let declarations: DeclarationBlock = {};
        Object.entries(properties).forEach((property) => {
            declarations = {
                ...declarations,
                ...this.stylizeProperty(property[0], property[1]),
            };
        });

        return {
            [`.${className}`]: declarations,
        };
    }

    protected stylizeProperty(
        property: PropertyName,
        value: PropertyValue,
    ): DeclarationBlock {
        return {
            [property]: value,
        };
    }

    protected stylizeUtility(utility: UtilityName, value: PropertyValue) {
        return this.stylizeProperty(this.getPropertyOf(utility), value);
    }

    protected stylizePropertyCallback(property: PropertyName): StyleCallback {
        return (value) => {
            return this.stylizeProperty(property, value);
        };
    }

    protected stylizeUtilityCallback(utility: UtilityName) {
        return this.stylizePropertyCallback(this.getPropertyOf(utility));
    }

    protected stylizeProperties(
        properties: PropertyName[],
        value: PropertyValue,
    ): DeclarationBlock {
        let rule: DeclarationBlock = {};
        properties.forEach((propertyName) => {
            rule = {
                ...rule,
                ...this.stylizeProperty(propertyName, value),
            };
        });
        return rule;
    }

    protected stylizeUtilities(utilities: UtilityName[], value: PropertyValue) {
        return this.stylizeProperties(this.getPropertiesOf(utilities), value);
    }

    protected stylizePropertiesCallback(
        properties: PropertyName[],
    ): StyleCallback {
        return (value) => {
            return this.stylizeProperties(properties, value);
        };
    }

    protected stylizeUtilitiesCallback(utilities: UtilityName[]) {
        return this.stylizePropertiesCallback(this.getPropertiesOf(utilities));
    }

    protected stylizeComponentsCallback(variant: string): StyleCallbacks {
        const { e } = this.api;
        const rules: StyleCallbacks = {};

        Object.entries(this.components).forEach((component) => {
            const name = `${component[0]}-${e(variant)}`;
            const utilities = component[1];

            if (typeof utilities === "string") {
                rules[name] = this.stylizeUtilityCallback(utilities);
            } else if (utilities instanceof Array) {
                rules[name] = this.stylizeUtilitiesCallback(utilities);
            } else {
                Object.entries(utilities).forEach((utility) => {
                    const utilityName =
                        utility[0] === "DEFAULT"
                            ? name
                            : `${name}-${e(utility[0])}`;
                    const properties = utility[1];
                    if (typeof properties === "string") {
                        rules[utilityName] =
                            this.stylizeUtilityCallback(properties);
                    } else {
                        rules[utilityName] =
                            this.stylizeUtilitiesCallback(properties);
                    }
                });
            }
        });
        return rules;
    }

    protected stylizeComponents(
        variant: string,
        value: PropertyValue,
    ): RuleSet {
        const { e } = this.api;
        let rules: RuleSet = {};

        Object.entries(this.components).forEach((component) => {
            const name = `${component[0]}-${e(variant)}`;
            const utilities = component[1];

            if (typeof utilities === "string") {
                rules = {
                    ...rules,
                    ...this.stylizeClass(
                        name,
                        this.stylizeUtility(utilities, value),
                    ),
                };
            } else if (utilities instanceof Array) {
                rules = {
                    ...rules,
                    ...this.stylizeClass(
                        name,
                        this.stylizeUtilities(utilities, value),
                    ),
                };
            } else {
                Object.entries(utilities).forEach((utility) => {
                    const utilityName =
                        utility[0] === "DEFAULT"
                            ? name
                            : `${name}-${e(utility[0])}`;
                    const properties = utility[1];
                    if (typeof properties === "string") {
                        rules = {
                            ...rules,
                            ...this.stylizeClass(
                                utilityName,
                                this.stylizeUtility(properties, value),
                            ),
                        };
                    } else {
                        rules = {
                            ...rules,
                            ...this.stylizeClass(
                                utilityName,
                                this.stylizeUtilities(properties, value),
                            ),
                        };
                    }
                });
            }
        });
        return rules;
    }

    protected addVar(name: string, value: string): this {
        return this.addBase({
            ":root": {
                [`--ui-${name}`]: value,
            },
        });
    }

    protected addBase(base: RuleSet | RuleSet[]): this {
        this.api.addBase(base);
        return this;
    }

    protected addComponents(components: RuleSet | RuleSet[]): this {
        this.api.addComponents(components);
        return this;
    }

    protected matchComponents(
        components: StyleCallbacks,
        values: StyleValues = {},
    ): this {
        this.api.matchComponents(components, {
            values,
        });
        return this;
    }

    protected addUtilities(utilities: RuleSet | RuleSet[]): this {
        this.api.addUtilities(utilities);
        return this;
    }

    protected matchUtilities(
        utilities: StyleCallbacks,
        values: StyleValues = {},
    ): this {
        this.api.matchUtilities(utilities, {
            values,
        });
        return this;
    }
}
