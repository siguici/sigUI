import { DarkModeConfig } from "tailwindcss/types/config";
import {
  ClassName,
  DeclarationBlock,
  PropertyName,
  PropertyValue,
  RuleSet,
  StyleCallback,
} from "./plugin";

export function darken(
  darkMode: Partial<DarkModeConfig>,
  ruleName: string,
  lightRules: RuleSet,
  darkRules: RuleSet | undefined = undefined,
): RuleSet {
  const rules: RuleSet = {};

  if (darkRules !== undefined) {
    let strategy: string;
    let selector: string | string[] | undefined;

    if (
      darkMode === "media" ||
      darkMode === "class" ||
      darkMode === "selector"
    ) {
      strategy = darkMode;
      selector = undefined;
    } else {
      strategy = darkMode[0] || "media";
      selector = darkMode[1];
    }

    switch (strategy) {
      case "variant": {
        const selectors = Array.isArray(selector)
          ? selector
          : [selector || ".dark"];
        for (const selector of selectors) {
          rules[ruleName] = {
            ...lightRules,
            [selector]: {
              ...darkRules,
            },
          };
        }
        break;
      }
      case "selector":
        rules[ruleName] = {
          ...lightRules,
          [`&:where(${selector || ".dark"}, ${selector || ".dark"} *)`]: {
            ...darkRules,
          },
        };
        break;
      case "class":
        rules[ruleName] = {
          ...lightRules,
          [`:is(${selector || ".dark"} &)`]: {
            ...darkRules,
          },
        };
        break;
      default:
        rules[ruleName] = {
          ...lightRules,
          "@media (prefers-color-scheme: dark)": {
            "&": {
              ...darkRules,
            },
          },
        };
    }
  } else {
    rules[ruleName] = lightRules;
  }

  return rules;
}

export function darkenClass(
  darkMode: Partial<DarkModeConfig>,
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
  // biome-ignore lint/complexity/noForEach: <explanation>
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
  // biome-ignore lint/complexity/noForEach: <explanation>
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
