import {
    ClassName,
    DarkMode,
    DeclarationBlock,
    PropertyName,
    PropertyValue,
    RuleSet,
    StyleCallback,
    StyleCallbacks,
} from "./types";

export class Util {
    static darken(
        darkMode: DarkMode,
        ruleName: string,
        lightRules: RuleSet,
        darkRules: RuleSet | undefined = undefined,
    ): RuleSet {
        const rules: RuleSet = {};

        if (darkRules !== undefined) {
            if (darkMode[0] === "media") {
                rules[ruleName] = {
                    ...lightRules,
                    [`@media (${darkMode[1]})`]: {
                        ["&"]: {
                            ...darkRules,
                        },
                    },
                };
            } else {
                rules[ruleName] = {
                    ...lightRules,
                    [`:is(${darkMode[1]} &)`]: {
                        ...darkRules,
                    },
                };
            }
        } else {
            rules[ruleName] = lightRules;
        }

        return rules;
    }

    static darkenClass(
        darkMode: DarkMode,
        className: string,
        lightRules: RuleSet,
        darkRules: RuleSet | undefined = undefined,
    ): RuleSet {
        return Util.darken(darkMode, `.${className}`, lightRules, darkRules);
    }

    static stylizeClass(
        className: ClassName,
        properties: DeclarationBlock,
    ): RuleSet {
        let declarations: DeclarationBlock = {};
        Object.entries(properties).forEach((property) => {
            declarations = Util.appendStyle(
                Util.stylizeProperty(property[0], property[1]),
                declarations,
            );
        });

        return {
            [`.${className}`]: declarations,
        };
    }

    static stylizeProperty(
        property: PropertyName,
        value: PropertyValue,
    ): DeclarationBlock {
        return {
            [property]: value,
        };
    }

    static stylizeProperties(
        properties: PropertyName[],
        value: PropertyValue,
    ): DeclarationBlock {
        let rule: DeclarationBlock = {};
        properties.forEach((propertyName) => {
            rule = Util.appendStyle(
                Util.stylizeProperty(propertyName, value),
                rule,
            );
        });
        return rule;
    }

    static stylizePropertyCallback(property: PropertyName): StyleCallback {
        return (value) => {
            return Util.stylizeProperty(property, value);
        };
    }

    static stylizePropertiesCallback(
        properties: PropertyName[],
    ): StyleCallback {
        return (value) => {
            return Util.stylizeProperties(properties, value);
        };
    }

    static appendStyle<T extends DeclarationBlock | RuleSet>(
        style: T,
        styles: T,
    ): T {
        return {
            ...styles,
            ...style,
        };
    }

    static prependStyle<T extends DeclarationBlock | RuleSet>(
        style: T,
        styles: T,
    ): T {
        return {
            ...style,
            ...styles,
        };
    }
}

export default Util;
