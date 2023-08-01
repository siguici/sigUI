import { DarkModeConfig, PluginAPI } from "tailwindcss/types/config";
import type { PluginContract } from "./Contracts/Plugin";
import type { DarkMode, ClassNames, DeclarationBlock, RuleSet, StyleCallbacks, StyleValues } from "./types";

export abstract class Plugin implements PluginContract
{
    protected darkMode: DarkMode = ["media", "prefers-color-scheme: dark"];

    constructor(protected api: PluginAPI) {
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

    abstract build(): void;

    public darken(
        className: string,
        lightRules: RuleSet,
        darkRules: RuleSet | undefined = undefined,
    ): RuleSet {
        const rules: RuleSet = {};
        const { e } = this.api;

        rules[`.${e(className)}`] = lightRules;

        if (darkRules !== undefined) {
            if (this.darkMode[0] === "media") {
                rules[`@media (${this.darkMode[1]})`] = {
                    [`.dark\\:${e(className)}`]: {
                        ...darkRules,
                    },
                };
            } else {
                rules[`:is(${e(this.darkMode[1])} .dark\\:${e(className)})`] = {
                    ...darkRules,
                };
            }
        }

        return rules;
    }

    public stylizeComponent(
        className: string,
        propertiesList: string[],
        propertiesValue: string,
    ): RuleSet {
        return {
            [`.${className}`]: this.stylizeProperties(
                propertiesList,
                propertiesValue,
            ),
        };
    }

    public stylizeUtility(
        className: string,
        propertyName: string,
        propertyValue: string,
    ): RuleSet {
        return {
            [`.${className}`]: this.stylizeProperty(
                propertyName,
                propertyValue,
            ),
        };
    }

    public stylizeProperties(
        properties: string[],
        value: string,
    ): DeclarationBlock {
        const declarations: DeclarationBlock = {};

        properties.forEach((property) => {
            declarations[property] = value;
        });

        return declarations;
    }

    public stylizeProperty(property: string, value: string): DeclarationBlock {
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