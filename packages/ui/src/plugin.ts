import type { DeclarationBlock, PluginAPI } from "plugwind.js";
import {
  type Config,
  type UserConfig,
  defaultConfig,
  defineConfig,
} from "./config";
import { isArray, isObject, isString } from "./utils";

export type PluginOptions = UserConfig;

export type UtilityList = string[];
export type UtilityMap = Record<string, string>;

export type ComponentValue = string | UtilityList;
export type ComponentVariant = Record<string, ComponentValue>;
export type ComponentOption = ComponentValue | ComponentVariant;

export type ComponentList = Record<string, ComponentOption>;

export function isUtilityList(utilities: unknown): utilities is UtilityList {
  return isArray<string>(utilities, isString);
}

export function isUtilityMap(utilities: unknown): utilities is UtilityMap {
  return isObject<string, string>(utilities, isString, isString);
}

export function isComponentValue(value: unknown): value is ComponentValue {
  return isString(value) || isUtilityList(value);
}

export function isComponentVariant(
  variant: unknown,
): variant is ComponentVariant {
  return isObject<string, ComponentValue>(variant, isString, isComponentValue);
}

export function isComponentOption(option: unknown): option is ComponentOption {
  return isComponentValue(option) || isComponentVariant(option);
}

function stylizeUtilities(
  utilityList: UtilityList,
  propertyValue: string,
  utilityMap: UtilityMap,
): DeclarationBlock {
  return utilityList.reduce<DeclarationBlock>((acc, utilityName) => {
    acc[utilityMap[utilityName]] = propertyValue;
    return acc;
  }, {} as DeclarationBlock);
}

export function addColors(
  api: PluginAPI,
  colors: ColorsConfig,
  config: Config = defaultConfig,
): void {
  for (const [colorName, colorOption] of Object.entries(colors)) {
    addColor(api, colorName, colorOption, config);
  }
}

export function addColor(
  api: PluginAPI,
  name: string,
  option: ColorOption,
  config = DEFAULT_OPTIONS,
): void {
  addColorComponents(api, name, option, config.components);
  addColorUtilities(api, name, option, config.utilities);
}

export function addColorComponents(
  api: PluginAPI,
  colorName: string,
  colorOption: ColorOption,
  componentList: ComponentList,
): void {
  for (const [componentName, componentOption] of Object.entries(
    componentList,
  )) {
    addColorComponent(
      api,
      componentName,
      componentOption,
      colorName,
      colorOption,
    );
  }
}

export function addColorComponent(
  api: PluginAPI,
  componentName: string,
  componentOption: ComponentOption,
  colorName: string,
  colorOption: ColorOption,
): void {
  if (isString(componentOption)) {
    addColorComponentUtility(
      api,
      componentName,
      componentOption,
      colorName,
      colorOption,
    );
    return;
  }

  if (isUtilityList(componentOption)) {
    addColorComponentUtilityList(
      api,
      componentName,
      componentOption,
      colorName,
      colorOption,
    );
    return;
  }

  addColorComponentVariant(
    api,
    componentName,
    componentOption,
    colorName,
    colorOption,
  );
}

export function addColorComponentUtility(
  api: PluginAPI,
  componentName: string,
  utilityName: string,
  colorName: string,
  colorOption: ColorOption,
  utilityMap: UtilityMap = {},
): void {
  const className = `${componentName}-${utilityName}-${colorName}`;
  const utility = utilityMap[utilityName];
  isString(colorOption)
    ? api.addUtility(className, {
        [utility]: colorOption,
      })
    : api.addDark(
        className,
        { [utility]: colorOption.light },
        { [utility]: colorOption.dark },
      );
}

export function addColorComponentUtilityList(
  api: PluginAPI,
  componentName: string,
  utilityList: UtilityList,
  colorName: string,
  colorOption: ColorOption,
  utilityMap: UtilityMap = {},
): void {
  const className = `${componentName}-${colorName}`;
  isString(colorOption)
    ? api.addComponent(
        className,
        stylizeUtilities(utilityList, colorOption, utilityMap),
      )
    : api.addDark(
        className,
        stylizeUtilities(utilityList, colorOption.light, utilityMap),
        stylizeUtilities(utilityList, colorOption.dark, utilityMap),
      );
}

export function addColorComponentVariant(
  api: PluginAPI,
  componentName: string,
  componentVariant: ComponentVariant,
  colorName: string,
  colorOption: ColorOption,
): void {
  for (const [variantName, utilities] of Object.entries(componentVariant)) {
    addColorComponent(
      api,
      variantName === "DEFAULT"
        ? componentName
        : `${componentName}-${variantName}`,
      utilities,
      colorName,
      colorOption,
    );
  }
}

export function addColorUtilities(
  api: PluginAPI,
  colorName: string,
  colorOption: ColorOption,
  utilityMap: UtilityMap,
): void {
  for (const [utilityName, propertyName] of Object.entries(utilityMap)) {
    addColorUtility(api, utilityName, propertyName, colorName, colorOption);
  }
}

export function addColorUtility(
  api: PluginAPI,
  utilityName: string,
  propertyName: string,
  colorName: string,
  colorOption: ColorOption,
): void {
  const className = `${utilityName}-${colorName}`;
  isString(colorOption)
    ? api.addUtility(className, { [propertyName]: colorOption })
    : api.addDark(
        className,
        { [propertyName]: colorOption.light },
        { [propertyName]: colorOption.dark },
      );
}

export default function (
  api: PluginAPI,
  options: PluginOptions = defaultConfig,
): void {
  const config: Config = defineConfig(options);
  makePlugin(api, config);
}
