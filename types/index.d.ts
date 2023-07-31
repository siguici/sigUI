import type colors from "tailwindcss/colors";

declare function plugin(
    options?: Partial<{ inputClass: string; buttonClass: string }>,
): { handler: () => void };

declare namespace plugin {
    const __isOptionsFunction: true;
}

export type DeclarationBlock = Record<string, string>;
export interface RuleSet {
    [key: string]: DeclarationBlock | RuleSet | string;
}
export type StyleCallback = (
    value: string,
    extra: { modifier: string | null },
) => RuleSet | null;
export type StyleCallbacks = Record<string, StyleCallback>;
export type StyleValues = Record<string, string>;

export type ColorName = keyof colors;
export type ColorValue = string;
export type ColorValues = Record<string | number, ColorValue>;
export type ColorVariants = Partial<{
    default: ColorValue;
    light: ColorValues;
    dark: ColorValues;
}>;

export type DarkModeStrategy = "class" | "media";
export type DarkModeQuery = string;
export type DarkMode = [DarkModeStrategy, DarkModeQuery];

export type PluggerOptions = Partial<{
    linkClass: string;
    entryClass: string;
    buttonClass: string;
}>;

export interface PluggerContract {
    plug: () => this;
}

export default plugin;
