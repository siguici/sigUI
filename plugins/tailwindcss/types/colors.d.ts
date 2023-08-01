import type colors from "tailwindcss/colors";

export type ColorName = keyof typeof colors;
export type ColorValue = string;
export type ColorValues = Record<string | number, ColorValue>;
export type ColorVariants = Partial<{
    default: ColorValue;
    light: ColorValues;
    dark: ColorValues;
}>;
