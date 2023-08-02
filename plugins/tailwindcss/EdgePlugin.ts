import { Plugin } from "./Plugin";
import { RequiredEdgeOptions } from "./types";
import defaultTheme from "tailwindcss/defaultTheme";

export class EdgePlugin extends Plugin<RequiredEdgeOptions> {
    create(): this {
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

        return this.addComponents({
            [this.options.entryClass]: entryStyle,
            [this.options.buttonClass]: buttonStyle,
        });
    }
}
