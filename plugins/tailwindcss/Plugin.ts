import type {
    ClassName,
    DarkMode,
    DeclarationBlock,
    PluginContract,
    PropertyName,
    PropertyValue,
    RuleSet,
    StyleCallbacks,
    StyleValues,
} from "./types";
import { DarkModeConfig, PluginAPI } from "tailwindcss/types/config";

export abstract class Plugin<T> implements PluginContract<T> {
    readonly darkMode: DarkMode = ["media", "prefers-color-scheme: dark"];

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

    public darken(
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

    public stylizeClass(
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

    public stylizeProperty(
        property: PropertyName,
        value: PropertyValue,
    ): DeclarationBlock {
        return {
            [property]: value,
        };
    }

    public addVar(name: string, value: string): this {
        return this.addBase({
            ":root": {
                [`--ui-${name}`]: value,
            },
        });
    }

    public addBase(base: RuleSet | RuleSet[]): this {
        this.api.addBase(base);
        return this;
    }

    public addComponents(components: RuleSet | RuleSet[]): this {
        this.api.addComponents(components);
        return this;
    }

    public matchComponents(
        components: StyleCallbacks,
        values: StyleValues = {},
    ): this {
        this.api.matchComponents(components, {
            values,
        });
        return this;
    }

    public addUtilities(utilities: RuleSet | RuleSet[]): this {
        this.api.addUtilities(utilities);
        return this;
    }

    public matchUtilities(
        utilities: StyleCallbacks,
        values: StyleValues = {},
    ): this {
        this.api.matchUtilities(utilities, {
            values,
        });
        return this;
    }
}
