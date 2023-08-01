export type ClassName = string;
export type ClassNames = ClassName[];

export type PropertyName = string;
export type PropertyValue = string;

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
