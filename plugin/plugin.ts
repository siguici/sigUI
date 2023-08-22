import { PluginContract } from "./contracts/plugin";
import {
    append_style,
    stylize_class,
    stylize_properties,
    stylize_properties_callback,
    stylize_property,
    stylize_property_callback,
} from "./helpers";
import type {
    ComponentList,
    DarkMode,
    PropertyName,
    PropertyValue,
    RuleSet,
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

    protected stylizeUtility(utility: UtilityName, value: PropertyValue) {
        return stylize_property(this.getPropertyOf(utility), value);
    }

    protected stylizeUtilityCallback(utility: UtilityName) {
        return stylize_property_callback(this.getPropertyOf(utility));
    }

    protected stylizeUtilities(utilities: UtilityName[], value: PropertyValue) {
        return stylize_properties(this.getPropertiesOf(utilities), value);
    }

    protected stylizeUtilitiesCallback(utilities: UtilityName[]) {
        return stylize_properties_callback(this.getPropertiesOf(utilities));
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
                rules = append_style(
                    stylize_class(name, this.stylizeUtility(utilities, value)),
                    rules,
                );
            } else if (utilities instanceof Array) {
                rules = append_style(
                    stylize_class(
                        name,
                        this.stylizeUtilities(utilities, value),
                    ),
                    rules,
                );
            } else {
                Object.entries(utilities).forEach((utility) => {
                    const utilityName =
                        utility[0] === "DEFAULT"
                            ? name
                            : `${name}-${e(utility[0])}`;
                    const properties = utility[1];
                    if (typeof properties === "string") {
                        rules = append_style(
                            stylize_class(
                                utilityName,
                                this.stylizeUtility(properties, value),
                            ),
                            rules,
                        );
                    } else {
                        rules = append_style(
                            stylize_class(
                                utilityName,
                                this.stylizeUtilities(properties, value),
                            ),
                            rules,
                        );
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
