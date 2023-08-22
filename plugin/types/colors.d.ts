import type colors from "tailwindcss/colors";

export type ColorName = keyof typeof colors;
export type ColorValue = string;
export type ColorValues = Record<string | number, ColorValue>;
export type RequiredColorVariants = {
    default: ColorValue;
    light: ColorValues;
    dark: ColorValues;
};
export type ColorVariants = Partial<RequiredColorVariants>;
