import colors from "./colors";

const reversible = true;
const modes = ["light", "dark"] as const;

const utilities = {
  text: "color",
  bg: "background-color",
  decoration: "text-decoration-color",
  border: "border-color",
  outline: "outline-color",
  accent: "accent-color",
  caret: "caret-color",
  divide: "border-color",
  fill: "fill",
  stroke: "stroke",
  shadow: "--tw-shadow-color",
  ring: "--tw-ring-color",
};

const components = {
  link: ["text", "decoration"],
  entry: ["text", "caret", "border"],
  choice: ["accent"],
  button: [
    "bg",
    {
      link: ["text", "decoration"],
      ring: ["text", "ring"],
      bordered: ["text", "border"],
      outlined: ["text", "outline"],
    },
  ],
};

const themes = {
  red: {
    link: {
      text: "red",
      decoration: "red",
    },
  },
};

export const defaultConfig = {
  reversible,
  modes,
  colors,
  utilities,
  components,
  themes,
};

export type Reversible = typeof reversible;
export type DefaultModes = typeof modes;
export type Mode = DefaultModes[number];
export type Modes = DefaultModes & Mode;
export type ColorScheme = { [key in Mode]: string };
export type DefaultColors = typeof colors;
export type DefaultColorName = keyof DefaultColors;
export type DefaultColorValue = DefaultColors[DefaultColorName];
export type ColorName = DefaultColorName | string;
export type ColorValue = DefaultColorValue | ColorScheme | string;
export type Colors = Record<ColorName, ColorValue>;
export type DefaultUtilities = typeof utilities;
export interface Utilities extends DefaultUtilities {
  [key: string]: string;
}
export type Components = typeof components;
export type ComponentName = keyof Components;
export type ComponentUtilities = Components[ComponentName];
export type ComponentUtility = ComponentUtilities[number];
export type Themes = typeof themes;
export type ThemeName = keyof Themes;
export type ThemeComponents = Themes[ThemeName];
export type ThemeComponent = keyof ThemeComponents;
export type ThemeUtilities = ThemeComponents[ThemeComponent];
export type ThemeUtility = keyof ThemeUtilities;
export type ThemeColors = ThemeUtilities[ThemeUtility];
export type ThemeColor = ThemeColors[number];
export type DefaultConfig = typeof defaultConfig;

export type UserConfig = {
  reversible?: Reversible;
  modes?: Modes;
  colors?: Colors;
  components?: Components;
  themes?: Themes;
};

export function defineConfig(config: UserConfig): Config {
  return { ...defaultConfig, ...config };
}

export type Config = DefaultConfig | UserConfig;
