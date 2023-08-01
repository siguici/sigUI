import { Plugin } from "./Plugin";
import { ClassName } from "./types";
import defaultTheme from "tailwindcss/defaultTheme";
import { PluginAPI } from "tailwindcss/types/config";

export class EdgePlugin extends Plugin {
    constructor(
        api: PluginAPI,
        readonly classNames: Partial<{
            entry: ClassName;
            button: ClassName;
        }> = {},
    ) {
        super(api);
    }

    build(): void {
        const { spacing, borderWidth, borderRadius } = defaultTheme;

        const boxStyle = {
            paddingLeft: spacing[4],
            paddingRight: spacing[4],
            paddingTop: spacing[2],
            paddingBottom: spacing[2],
        };

        const borderStyle = {
            borderWidth: borderWidth[2],
            borderRadius: borderRadius.md,

            "&-l": {
                borderRightWidth: spacing[0],
                borderRadius: borderRadius.none,
                borderTopLeftRadius: borderRadius.md,
                borderBottomLeftRadius: borderRadius.md,
            },

            "&-r": {
                borderLeftWidth: spacing[0],
                borderRadius: borderRadius.none,
                borderTopRightRadius: borderRadius.md,
                borderBottomRightRadius: borderRadius.md,
            },

            "&-t": {
                borderBottomWidth: spacing[0],
                borderRadius: borderRadius.none,
                borderTopLeftRadius: borderRadius.md,
                borderTopRightRadius: borderRadius.md,
            },

            "&-b": {
                borderRightWidth: spacing[0],
                borderRadius: borderRadius.none,
                borderBottomLeftRadius: borderRadius.md,
                borderBottomRightRadius: borderRadius.md,
            },
        };

        const entryStyle = {
            ...boxStyle,
            ...borderStyle,
        };

        const buttonStyle = {
            ...boxStyle,
            ...borderStyle,
        };

        this.addComponents({
            [this.classNames.entry ?? "entry"]: entryStyle,
            [this.classNames.button ?? "button"]: buttonStyle,
        });
    }
}
