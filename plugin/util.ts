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

export function darken(
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
                    "&": {
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

export function darkenClass(
    darkMode: DarkMode,
    className: string,
    lightRules: RuleSet,
    darkRules: RuleSet | undefined = undefined,
): RuleSet {
    return darken(darkMode, `.${className}`, lightRules, darkRules);
}

export function stylizeClass(
    className: ClassName,
    properties: DeclarationBlock,
): RuleSet {
    let declarations: DeclarationBlock = {};
    Object.entries(properties).forEach((property) => {
        declarations = appendStyle(
            stylizeProperty(property[0], property[1]),
            declarations,
        );
    });

    return {
        [`.${className}`]: declarations,
    };
}

export function stylizeProperty(
    property: PropertyName,
    value: PropertyValue,
): DeclarationBlock {
    return {
        [property]: value,
    };
}

export function stylizeProperties(
    properties: PropertyName[],
    value: PropertyValue,
): DeclarationBlock {
    let rule: DeclarationBlock = {};
    properties.forEach((propertyName) => {
        rule = appendStyle(stylizeProperty(propertyName, value), rule);
    });
    return rule;
}

export function stylizePropertyCallback(property: PropertyName): StyleCallback {
    return (value) => {
        return stylizeProperty(property, value);
    };
}

export function stylizePropertiesCallback(
    properties: PropertyName[],
): StyleCallback {
    return (value) => {
        return stylizeProperties(properties, value);
    };
}

export function appendStyle<T extends DeclarationBlock | RuleSet>(
    style: T,
    styles: T,
): T {
    return {
        ...styles,
        ...style,
    };
}

export function prependStyle<T extends DeclarationBlock | RuleSet>(
    style: T,
    styles: T,
): T {
    return {
        ...style,
        ...styles,
    };
}
