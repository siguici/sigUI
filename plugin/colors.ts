import colors from "tailwindcss/colors";
import {
    append_style,
    darken_class,
    stylize_class,
    stylize_property,
} from "./helpers";
import { Plugin } from "./plugin";
import {
    ColorName,
    ColorValue,
    ColorValues,
    ColorVariants,
    ComponentList,
    RuleSet,
    StyleCallbacks,
    UtilityList,
} from "./types";

export class Colors extends Plugin<void> {
    readonly components: ComponentList = {
        link: ["text", "decoration"],

        entry: ["text", "caret", "border"],

        choice: ["accent"],

        button: {
            DEFAULT: ["bg"],
            link: ["text", "decoration"],
            ring: ["text", "ring"],
            bordered: ["text", "border"],
            outlined: ["text", "outline"],
        },
    };

    readonly utilities: UtilityList = {
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

    public create(): this {
        for (const name in colors) {
            const colorDetails = this.getDetailsColorOf(name as ColorName);
            this.addColor(name, colorDetails);
        }
        return this;
    }

    public getDetailsColorOf(name: ColorName): ColorVariants {
        const { theme } = this.api;
        let color: ColorVariants;

        switch (name) {
            case "slate":
                color = {
                    default: theme(
                        "colors.slate.default",
                        theme("colors.slate.500", colors.slate[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.slate.light.0",
                            theme("colors.slate.50", colors.slate[50]),
                        ),
                        "1": theme(
                            "colors.slate.light.1",
                            theme("colors.slate.100", colors.slate[100]),
                        ),
                        "2": theme(
                            "colors.slate.light.2",
                            theme("colors.slate.200", colors.slate[200]),
                        ),
                        "3": theme(
                            "colors.slate.light.3",
                            theme("colors.slate.300", colors.slate[300]),
                        ),
                        "4": theme(
                            "colors.slate.light.4",
                            theme("colors.slate.400", colors.slate[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.slate.dark.0",
                            theme("colors.slate.950", colors.slate[950]),
                        ),
                        "1": theme(
                            "colors.slate.dark.1",
                            theme("colors.slate.900", colors.slate[900]),
                        ),
                        "2": theme(
                            "colors.slate.dark.2",
                            theme("colors.slate.800", colors.slate[800]),
                        ),
                        "3": theme(
                            "colors.slate.dark.3",
                            theme("colors.slate.700", colors.slate[700]),
                        ),
                        "4": theme(
                            "colors.slate.dark.4",
                            theme("colors.slate.600", colors.slate[600]),
                        ),
                    },
                };
                break;
            case "gray":
                color = {
                    default: theme(
                        "colors.gray.default",
                        theme("colors.gray.500", colors.gray[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.gray.light.0",
                            theme("colors.gray.50", colors.gray[50]),
                        ),
                        "1": theme(
                            "colors.gray.light.1",
                            theme("colors.gray.100", colors.gray[100]),
                        ),
                        "2": theme(
                            "colors.gray.light.2",
                            theme("colors.gray.200", colors.gray[200]),
                        ),
                        "3": theme(
                            "colors.gray.light.3",
                            theme("colors.gray.300", colors.gray[300]),
                        ),
                        "4": theme(
                            "colors.gray.light.4",
                            theme("colors.gray.400", colors.gray[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.gray.dark.0",
                            theme("colors.gray.950", colors.gray[950]),
                        ),
                        "1": theme(
                            "colors.gray.dark.1",
                            theme("colors.gray.900", colors.gray[900]),
                        ),
                        "2": theme(
                            "colors.gray.dark.2",
                            theme("colors.gray.800", colors.gray[800]),
                        ),
                        "3": theme(
                            "colors.gray.dark.3",
                            theme("colors.gray.700", colors.gray[700]),
                        ),
                        "4": theme(
                            "colors.gray.dark.4",
                            theme("colors.gray.600", colors.gray[600]),
                        ),
                    },
                };
                break;
            case "zinc":
                color = {
                    default: theme(
                        "colors.zinc.default",
                        theme("colors.zinc.500", colors.zinc[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.zinc.light.0",
                            theme("colors.zinc.50", colors.zinc[50]),
                        ),
                        "1": theme(
                            "colors.zinc.light.1",
                            theme("colors.zinc.100", colors.zinc[100]),
                        ),
                        "2": theme(
                            "colors.zinc.light.2",
                            theme("colors.zinc.200", colors.zinc[200]),
                        ),
                        "3": theme(
                            "colors.zinc.light.3",
                            theme("colors.zinc.300", colors.zinc[300]),
                        ),
                        "4": theme(
                            "colors.zinc.light.4",
                            theme("colors.zinc.400", colors.zinc[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.zinc.dark.0",
                            theme("colors.zinc.950", colors.zinc[950]),
                        ),
                        "1": theme(
                            "colors.zinc.dark.1",
                            theme("colors.zinc.900", colors.zinc[900]),
                        ),
                        "2": theme(
                            "colors.zinc.dark.2",
                            theme("colors.zinc.800", colors.zinc[800]),
                        ),
                        "3": theme(
                            "colors.zinc.dark.3",
                            theme("colors.zinc.700", colors.zinc[700]),
                        ),
                        "4": theme(
                            "colors.zinc.dark.4",
                            theme("colors.zinc.600", colors.zinc[600]),
                        ),
                    },
                };
                break;
            case "neutral":
                color = {
                    default: theme(
                        "colors.neutral.default",
                        theme("colors.neutral.500", colors.neutral[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.neutral.light.0",
                            theme("colors.neutral.50", colors.neutral[50]),
                        ),
                        "1": theme(
                            "colors.neutral.light.1",
                            theme("colors.neutral.100", colors.neutral[100]),
                        ),
                        "2": theme(
                            "colors.neutral.light.2",
                            theme("colors.neutral.200", colors.neutral[200]),
                        ),
                        "3": theme(
                            "colors.neutral.light.3",
                            theme("colors.neutral.300", colors.neutral[300]),
                        ),
                        "4": theme(
                            "colors.neutral.light.4",
                            theme("colors.neutral.400", colors.neutral[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.neutral.dark.0",
                            theme("colors.neutral.950", colors.neutral[950]),
                        ),
                        "1": theme(
                            "colors.neutral.dark.1",
                            theme("colors.neutral.900", colors.neutral[900]),
                        ),
                        "2": theme(
                            "colors.neutral.dark.2",
                            theme("colors.neutral.800", colors.neutral[800]),
                        ),
                        "3": theme(
                            "colors.neutral.dark.3",
                            theme("colors.neutral.700", colors.neutral[700]),
                        ),
                        "4": theme(
                            "colors.neutral.dark.4",
                            theme("colors.neutral.600", colors.neutral[600]),
                        ),
                    },
                };
                break;
            case "stone":
                color = {
                    default: theme(
                        "colors.stone.default",
                        theme("colors.stone.500", colors.stone[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.stone.light.0",
                            theme("colors.stone.50", colors.stone[50]),
                        ),
                        "1": theme(
                            "colors.stone.light.1",
                            theme("colors.stone.100", colors.stone[100]),
                        ),
                        "2": theme(
                            "colors.stone.light.2",
                            theme("colors.stone.200", colors.stone[200]),
                        ),
                        "3": theme(
                            "colors.stone.light.3",
                            theme("colors.stone.300", colors.stone[300]),
                        ),
                        "4": theme(
                            "colors.stone.light.4",
                            theme("colors.stone.400", colors.stone[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.stone.dark.0",
                            theme("colors.stone.950", colors.stone[950]),
                        ),
                        "1": theme(
                            "colors.stone.dark.1",
                            theme("colors.stone.900", colors.stone[900]),
                        ),
                        "2": theme(
                            "colors.stone.dark.2",
                            theme("colors.stone.800", colors.stone[800]),
                        ),
                        "3": theme(
                            "colors.stone.dark.3",
                            theme("colors.stone.700", colors.stone[700]),
                        ),
                        "4": theme(
                            "colors.stone.dark.4",
                            theme("colors.stone.600", colors.stone[600]),
                        ),
                    },
                };
                break;
            case "red":
                color = {
                    default: theme(
                        "colors.red.default",
                        theme("colors.red.500", colors.red[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.red.light.0",
                            theme("colors.red.50", colors.red[50]),
                        ),
                        "1": theme(
                            "colors.red.light.1",
                            theme("colors.red.100", colors.red[100]),
                        ),
                        "2": theme(
                            "colors.red.light.2",
                            theme("colors.red.200", colors.red[200]),
                        ),
                        "3": theme(
                            "colors.red.light.3",
                            theme("colors.red.300", colors.red[300]),
                        ),
                        "4": theme(
                            "colors.red.light.4",
                            theme("colors.red.400", colors.red[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.red.dark.0",
                            theme("colors.red.950", colors.red[950]),
                        ),
                        "1": theme(
                            "colors.red.dark.1",
                            theme("colors.red.900", colors.red[900]),
                        ),
                        "2": theme(
                            "colors.red.dark.2",
                            theme("colors.red.800", colors.red[800]),
                        ),
                        "3": theme(
                            "colors.red.dark.3",
                            theme("colors.red.700", colors.red[700]),
                        ),
                        "4": theme(
                            "colors.red.dark.4",
                            theme("colors.red.600", colors.red[600]),
                        ),
                    },
                };
                break;
            case "orange":
                color = {
                    default: theme(
                        "colors.orange.default",
                        theme("colors.orange.500", colors.orange[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.orange.light.0",
                            theme("colors.orange.50", colors.orange[50]),
                        ),
                        "1": theme(
                            "colors.orange.light.1",
                            theme("colors.orange.100", colors.orange[100]),
                        ),
                        "2": theme(
                            "colors.orange.light.2",
                            theme("colors.orange.200", colors.orange[200]),
                        ),
                        "3": theme(
                            "colors.orange.light.3",
                            theme("colors.orange.300", colors.orange[300]),
                        ),
                        "4": theme(
                            "colors.orange.light.4",
                            theme("colors.orange.400", colors.orange[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.orange.dark.0",
                            theme("colors.orange.950", colors.orange[950]),
                        ),
                        "1": theme(
                            "colors.orange.dark.1",
                            theme("colors.orange.900", colors.orange[900]),
                        ),
                        "2": theme(
                            "colors.orange.dark.2",
                            theme("colors.orange.800", colors.orange[800]),
                        ),
                        "3": theme(
                            "colors.orange.dark.3",
                            theme("colors.orange.700", colors.orange[700]),
                        ),
                        "4": theme(
                            "colors.orange.dark.4",
                            theme("colors.orange.600", colors.orange[600]),
                        ),
                    },
                };
                break;
            case "amber":
                color = {
                    default: theme(
                        "colors.amber.default",
                        theme("colors.amber.500", colors.amber[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.amber.light.0",
                            theme("colors.amber.50", colors.amber[50]),
                        ),
                        "1": theme(
                            "colors.amber.light.1",
                            theme("colors.amber.100", colors.amber[100]),
                        ),
                        "2": theme(
                            "colors.amber.light.2",
                            theme("colors.amber.200", colors.amber[200]),
                        ),
                        "3": theme(
                            "colors.amber.light.3",
                            theme("colors.amber.300", colors.amber[300]),
                        ),
                        "4": theme(
                            "colors.amber.light.4",
                            theme("colors.amber.400", colors.amber[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.amber.dark.0",
                            theme("colors.amber.950", colors.amber[950]),
                        ),
                        "1": theme(
                            "colors.amber.dark.1",
                            theme("colors.amber.900", colors.amber[900]),
                        ),
                        "2": theme(
                            "colors.amber.dark.2",
                            theme("colors.amber.800", colors.amber[800]),
                        ),
                        "3": theme(
                            "colors.amber.dark.3",
                            theme("colors.amber.700", colors.amber[700]),
                        ),
                        "4": theme(
                            "colors.amber.dark.4",
                            theme("colors.amber.600", colors.amber[600]),
                        ),
                    },
                };
                break;
            case "yellow":
                color = {
                    default: theme(
                        "colors.yellow.default",
                        theme("colors.yellow.500", colors.yellow[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.yellow.light.0",
                            theme("colors.yellow.50", colors.yellow[50]),
                        ),
                        "1": theme(
                            "colors.yellow.light.1",
                            theme("colors.yellow.100", colors.yellow[100]),
                        ),
                        "2": theme(
                            "colors.yellow.light.2",
                            theme("colors.yellow.200", colors.yellow[200]),
                        ),
                        "3": theme(
                            "colors.yellow.light.3",
                            theme("colors.yellow.300", colors.yellow[300]),
                        ),
                        "4": theme(
                            "colors.yellow.light.4",
                            theme("colors.yellow.400", colors.yellow[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.yellow.dark.0",
                            theme("colors.yellow.950", colors.yellow[950]),
                        ),
                        "1": theme(
                            "colors.yellow.dark.1",
                            theme("colors.yellow.900", colors.yellow[900]),
                        ),
                        "2": theme(
                            "colors.yellow.dark.2",
                            theme("colors.yellow.800", colors.yellow[800]),
                        ),
                        "3": theme(
                            "colors.yellow.dark.3",
                            theme("colors.yellow.700", colors.yellow[700]),
                        ),
                        "4": theme(
                            "colors.yellow.dark.4",
                            theme("colors.yellow.600", colors.yellow[600]),
                        ),
                    },
                };
                break;
            case "lime":
                color = {
                    default: theme(
                        "colors.lime.default",
                        theme("colors.lime.500", colors.lime[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.lime.light.0",
                            theme("colors.lime.50", colors.lime[50]),
                        ),
                        "1": theme(
                            "colors.lime.light.1",
                            theme("colors.lime.100", colors.lime[100]),
                        ),
                        "2": theme(
                            "colors.lime.light.2",
                            theme("colors.lime.200", colors.lime[200]),
                        ),
                        "3": theme(
                            "colors.lime.light.3",
                            theme("colors.lime.300", colors.lime[300]),
                        ),
                        "4": theme(
                            "colors.lime.light.4",
                            theme("colors.lime.400", colors.lime[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.lime.dark.0",
                            theme("colors.lime.950", colors.lime[950]),
                        ),
                        "1": theme(
                            "colors.lime.dark.1",
                            theme("colors.lime.900", colors.lime[900]),
                        ),
                        "2": theme(
                            "colors.lime.dark.2",
                            theme("colors.lime.800", colors.lime[800]),
                        ),
                        "3": theme(
                            "colors.lime.dark.3",
                            theme("colors.lime.700", colors.lime[700]),
                        ),
                        "4": theme(
                            "colors.lime.dark.4",
                            theme("colors.lime.600", colors.lime[600]),
                        ),
                    },
                };
                break;
            case "green":
                color = {
                    default: theme(
                        "colors.green.default",
                        theme("colors.green.500", colors.green[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.green.light.0",
                            theme("colors.green.50", colors.green[50]),
                        ),
                        "1": theme(
                            "colors.green.light.1",
                            theme("colors.green.100", colors.green[100]),
                        ),
                        "2": theme(
                            "colors.green.light.2",
                            theme("colors.green.200", colors.green[200]),
                        ),
                        "3": theme(
                            "colors.green.light.3",
                            theme("colors.green.300", colors.green[300]),
                        ),
                        "4": theme(
                            "colors.green.light.4",
                            theme("colors.green.400", colors.green[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.green.dark.0",
                            theme("colors.green.950", colors.green[950]),
                        ),
                        "1": theme(
                            "colors.green.dark.1",
                            theme("colors.green.900", colors.green[900]),
                        ),
                        "2": theme(
                            "colors.green.dark.2",
                            theme("colors.green.800", colors.green[800]),
                        ),
                        "3": theme(
                            "colors.green.dark.3",
                            theme("colors.green.700", colors.green[700]),
                        ),
                        "4": theme(
                            "colors.green.dark.4",
                            theme("colors.green.600", colors.green[600]),
                        ),
                    },
                };
                break;
            case "emerald":
                color = {
                    default: theme(
                        "colors.emerald.default",
                        theme("colors.emerald.500", colors.emerald[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.emerald.light.0",
                            theme("colors.emerald.50", colors.emerald[50]),
                        ),
                        "1": theme(
                            "colors.emerald.light.1",
                            theme("colors.emerald.100", colors.emerald[100]),
                        ),
                        "2": theme(
                            "colors.emerald.light.2",
                            theme("colors.emerald.200", colors.emerald[200]),
                        ),
                        "3": theme(
                            "colors.emerald.light.3",
                            theme("colors.emerald.300", colors.emerald[300]),
                        ),
                        "4": theme(
                            "colors.emerald.light.4",
                            theme("colors.emerald.400", colors.emerald[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.emerald.dark.0",
                            theme("colors.emerald.950", colors.emerald[950]),
                        ),
                        "1": theme(
                            "colors.emerald.dark.1",
                            theme("colors.emerald.900", colors.emerald[900]),
                        ),
                        "2": theme(
                            "colors.emerald.dark.2",
                            theme("colors.emerald.800", colors.emerald[800]),
                        ),
                        "3": theme(
                            "colors.emerald.dark.3",
                            theme("colors.emerald.700", colors.emerald[700]),
                        ),
                        "4": theme(
                            "colors.emerald.dark.4",
                            theme("colors.emerald.600", colors.emerald[600]),
                        ),
                    },
                };
                break;
            case "teal":
                color = {
                    default: theme(
                        "colors.teal.default",
                        theme("colors.teal.500", colors.teal[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.teal.light.0",
                            theme("colors.teal.50", colors.teal[50]),
                        ),
                        "1": theme(
                            "colors.teal.light.1",
                            theme("colors.teal.100", colors.teal[100]),
                        ),
                        "2": theme(
                            "colors.teal.light.2",
                            theme("colors.teal.200", colors.teal[200]),
                        ),
                        "3": theme(
                            "colors.teal.light.3",
                            theme("colors.teal.300", colors.teal[300]),
                        ),
                        "4": theme(
                            "colors.teal.light.4",
                            theme("colors.teal.400", colors.teal[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.teal.dark.0",
                            theme("colors.teal.950", colors.teal[950]),
                        ),
                        "1": theme(
                            "colors.teal.dark.1",
                            theme("colors.teal.900", colors.teal[900]),
                        ),
                        "2": theme(
                            "colors.teal.dark.2",
                            theme("colors.teal.800", colors.teal[800]),
                        ),
                        "3": theme(
                            "colors.teal.dark.3",
                            theme("colors.teal.700", colors.teal[700]),
                        ),
                        "4": theme(
                            "colors.teal.dark.4",
                            theme("colors.teal.600", colors.teal[600]),
                        ),
                    },
                };
                break;
            case "cyan":
                color = {
                    default: theme(
                        "colors.cyan.default",
                        theme("colors.cyan.500", colors.cyan[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.cyan.light.0",
                            theme("colors.cyan.50", colors.cyan[50]),
                        ),
                        "1": theme(
                            "colors.cyan.light.1",
                            theme("colors.cyan.100", colors.cyan[100]),
                        ),
                        "2": theme(
                            "colors.cyan.light.2",
                            theme("colors.cyan.200", colors.cyan[200]),
                        ),
                        "3": theme(
                            "colors.cyan.light.3",
                            theme("colors.cyan.300", colors.cyan[300]),
                        ),
                        "4": theme(
                            "colors.cyan.light.4",
                            theme("colors.cyan.400", colors.cyan[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.cyan.dark.0",
                            theme("colors.cyan.950", colors.cyan[950]),
                        ),
                        "1": theme(
                            "colors.cyan.dark.1",
                            theme("colors.cyan.900", colors.cyan[900]),
                        ),
                        "2": theme(
                            "colors.cyan.dark.2",
                            theme("colors.cyan.800", colors.cyan[800]),
                        ),
                        "3": theme(
                            "colors.cyan.dark.3",
                            theme("colors.cyan.700", colors.cyan[700]),
                        ),
                        "4": theme(
                            "colors.cyan.dark.4",
                            theme("colors.cyan.600", colors.cyan[600]),
                        ),
                    },
                };
                break;
            case "sky":
                color = {
                    default: theme(
                        "colors.sky.default",
                        theme("colors.sky.500", colors.sky[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.sky.light.0",
                            theme("colors.sky.50", colors.sky[50]),
                        ),
                        "1": theme(
                            "colors.sky.light.1",
                            theme("colors.sky.100", colors.sky[100]),
                        ),
                        "2": theme(
                            "colors.sky.light.2",
                            theme("colors.sky.200", colors.sky[200]),
                        ),
                        "3": theme(
                            "colors.sky.light.3",
                            theme("colors.sky.300", colors.sky[300]),
                        ),
                        "4": theme(
                            "colors.sky.light.4",
                            theme("colors.sky.400", colors.sky[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.sky.dark.0",
                            theme("colors.sky.950", colors.sky[950]),
                        ),
                        "1": theme(
                            "colors.sky.dark.1",
                            theme("colors.sky.900", colors.sky[900]),
                        ),
                        "2": theme(
                            "colors.sky.dark.2",
                            theme("colors.sky.800", colors.sky[800]),
                        ),
                        "3": theme(
                            "colors.sky.dark.3",
                            theme("colors.sky.700", colors.sky[700]),
                        ),
                        "4": theme(
                            "colors.sky.dark.4",
                            theme("colors.sky.600", colors.sky[600]),
                        ),
                    },
                };
                break;
            case "blue":
                color = {
                    default: theme(
                        "colors.blue.default",
                        theme("colors.blue.500", colors.blue[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.blue.light.0",
                            theme("colors.blue.50", colors.blue[50]),
                        ),
                        "1": theme(
                            "colors.blue.light.1",
                            theme("colors.blue.100", colors.blue[100]),
                        ),
                        "2": theme(
                            "colors.blue.light.2",
                            theme("colors.blue.200", colors.blue[200]),
                        ),
                        "3": theme(
                            "colors.blue.light.3",
                            theme("colors.blue.300", colors.blue[300]),
                        ),
                        "4": theme(
                            "colors.blue.light.4",
                            theme("colors.blue.400", colors.blue[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.blue.dark.0",
                            theme("colors.blue.950", colors.blue[950]),
                        ),
                        "1": theme(
                            "colors.blue.dark.1",
                            theme("colors.blue.900", colors.blue[900]),
                        ),
                        "2": theme(
                            "colors.blue.dark.2",
                            theme("colors.blue.800", colors.blue[800]),
                        ),
                        "3": theme(
                            "colors.blue.dark.3",
                            theme("colors.blue.700", colors.blue[700]),
                        ),
                        "4": theme(
                            "colors.blue.dark.4",
                            theme("colors.blue.600", colors.blue[600]),
                        ),
                    },
                };
                break;
            case "indigo":
                color = {
                    default: theme(
                        "colors.indigo.default",
                        theme("colors.indigo.500", colors.indigo[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.indigo.light.0",
                            theme("colors.indigo.50", colors.indigo[50]),
                        ),
                        "1": theme(
                            "colors.indigo.light.1",
                            theme("colors.indigo.100", colors.indigo[100]),
                        ),
                        "2": theme(
                            "colors.indigo.light.2",
                            theme("colors.indigo.200", colors.indigo[200]),
                        ),
                        "3": theme(
                            "colors.indigo.light.3",
                            theme("colors.indigo.300", colors.indigo[300]),
                        ),
                        "4": theme(
                            "colors.indigo.light.4",
                            theme("colors.indigo.400", colors.indigo[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.indigo.dark.0",
                            theme("colors.indigo.950", colors.indigo[950]),
                        ),
                        "1": theme(
                            "colors.indigo.dark.1",
                            theme("colors.indigo.900", colors.indigo[900]),
                        ),
                        "2": theme(
                            "colors.indigo.dark.2",
                            theme("colors.indigo.800", colors.indigo[800]),
                        ),
                        "3": theme(
                            "colors.indigo.dark.3",
                            theme("colors.indigo.700", colors.indigo[700]),
                        ),
                        "4": theme(
                            "colors.indigo.dark.4",
                            theme("colors.indigo.600", colors.indigo[600]),
                        ),
                    },
                };
                break;
            case "violet":
                color = {
                    default: theme(
                        "colors.violet.default",
                        theme("colors.violet.500", colors.violet[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.violet.light.0",
                            theme("colors.violet.50", colors.violet[50]),
                        ),
                        "1": theme(
                            "colors.violet.light.1",
                            theme("colors.violet.100", colors.violet[100]),
                        ),
                        "2": theme(
                            "colors.violet.light.2",
                            theme("colors.violet.200", colors.violet[200]),
                        ),
                        "3": theme(
                            "colors.violet.light.3",
                            theme("colors.violet.300", colors.violet[300]),
                        ),
                        "4": theme(
                            "colors.violet.light.4",
                            theme("colors.violet.400", colors.violet[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.violet.dark.0",
                            theme("colors.violet.950", colors.violet[950]),
                        ),
                        "1": theme(
                            "colors.violet.dark.1",
                            theme("colors.violet.900", colors.violet[900]),
                        ),
                        "2": theme(
                            "colors.violet.dark.2",
                            theme("colors.violet.800", colors.violet[800]),
                        ),
                        "3": theme(
                            "colors.violet.dark.3",
                            theme("colors.violet.700", colors.violet[700]),
                        ),
                        "4": theme(
                            "colors.violet.dark.4",
                            theme("colors.violet.600", colors.violet[600]),
                        ),
                    },
                };
                break;
            case "purple":
                color = {
                    default: theme(
                        "colors.purple.default",
                        theme("colors.purple.500", colors.purple[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.purple.light.0",
                            theme("colors.purple.50", colors.purple[50]),
                        ),
                        "1": theme(
                            "colors.purple.light.1",
                            theme("colors.purple.100", colors.purple[100]),
                        ),
                        "2": theme(
                            "colors.purple.light.2",
                            theme("colors.purple.200", colors.purple[200]),
                        ),
                        "3": theme(
                            "colors.purple.light.3",
                            theme("colors.purple.300", colors.purple[300]),
                        ),
                        "4": theme(
                            "colors.purple.light.4",
                            theme("colors.purple.400", colors.purple[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.purple.dark.0",
                            theme("colors.purple.950", colors.purple[950]),
                        ),
                        "1": theme(
                            "colors.purple.dark.1",
                            theme("colors.purple.900", colors.purple[900]),
                        ),
                        "2": theme(
                            "colors.purple.dark.2",
                            theme("colors.purple.800", colors.purple[800]),
                        ),
                        "3": theme(
                            "colors.purple.dark.3",
                            theme("colors.purple.700", colors.purple[700]),
                        ),
                        "4": theme(
                            "colors.purple.dark.4",
                            theme("colors.purple.600", colors.purple[600]),
                        ),
                    },
                };
                break;
            case "fuchsia":
                color = {
                    default: theme(
                        "colors.fuchsia.default",
                        theme("colors.fuchsia.500", colors.fuchsia[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.fuchsia.light.0",
                            theme("colors.fuchsia.50", colors.fuchsia[50]),
                        ),
                        "1": theme(
                            "colors.fuchsia.light.1",
                            theme("colors.fuchsia.100", colors.fuchsia[100]),
                        ),
                        "2": theme(
                            "colors.fuchsia.light.2",
                            theme("colors.fuchsia.200", colors.fuchsia[200]),
                        ),
                        "3": theme(
                            "colors.fuchsia.light.3",
                            theme("colors.fuchsia.300", colors.fuchsia[300]),
                        ),
                        "4": theme(
                            "colors.fuchsia.light.4",
                            theme("colors.fuchsia.400", colors.fuchsia[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.fuchsia.dark.0",
                            theme("colors.fuchsia.950", colors.fuchsia[950]),
                        ),
                        "1": theme(
                            "colors.fuchsia.dark.1",
                            theme("colors.fuchsia.900", colors.fuchsia[900]),
                        ),
                        "2": theme(
                            "colors.fuchsia.dark.2",
                            theme("colors.fuchsia.800", colors.fuchsia[800]),
                        ),
                        "3": theme(
                            "colors.fuchsia.dark.3",
                            theme("colors.fuchsia.700", colors.fuchsia[700]),
                        ),
                        "4": theme(
                            "colors.fuchsia.dark.4",
                            theme("colors.fuchsia.600", colors.fuchsia[600]),
                        ),
                    },
                };
                break;
            case "pink":
                color = {
                    default: theme(
                        "colors.pink.default",
                        theme("colors.pink.500", colors.pink[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.pink.light.0",
                            theme("colors.pink.50", colors.pink[50]),
                        ),
                        "1": theme(
                            "colors.pink.light.1",
                            theme("colors.pink.100", colors.pink[100]),
                        ),
                        "2": theme(
                            "colors.pink.light.2",
                            theme("colors.pink.200", colors.pink[200]),
                        ),
                        "3": theme(
                            "colors.pink.light.3",
                            theme("colors.pink.300", colors.pink[300]),
                        ),
                        "4": theme(
                            "colors.pink.light.4",
                            theme("colors.pink.400", colors.pink[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.pink.dark.0",
                            theme("colors.pink.950", colors.pink[950]),
                        ),
                        "1": theme(
                            "colors.pink.dark.1",
                            theme("colors.pink.900", colors.pink[900]),
                        ),
                        "2": theme(
                            "colors.pink.dark.2",
                            theme("colors.pink.800", colors.pink[800]),
                        ),
                        "3": theme(
                            "colors.pink.dark.3",
                            theme("colors.pink.700", colors.pink[700]),
                        ),
                        "4": theme(
                            "colors.pink.dark.4",
                            theme("colors.pink.600", colors.pink[600]),
                        ),
                    },
                };
                break;
            case "rose":
                color = {
                    default: theme(
                        "colors.rose.default",
                        theme("colors.rose.500", colors.rose[500]),
                    ),
                    light: {
                        "0": theme(
                            "colors.rose.light.0",
                            theme("colors.rose.50", colors.rose[50]),
                        ),
                        "1": theme(
                            "colors.rose.light.1",
                            theme("colors.rose.100", colors.rose[100]),
                        ),
                        "2": theme(
                            "colors.rose.light.2",
                            theme("colors.rose.200", colors.rose[200]),
                        ),
                        "3": theme(
                            "colors.rose.light.3",
                            theme("colors.rose.300", colors.rose[300]),
                        ),
                        "4": theme(
                            "colors.rose.light.4",
                            theme("colors.rose.400", colors.rose[400]),
                        ),
                    },
                    dark: {
                        "0": theme(
                            "colors.rose.dark.0",
                            theme("colors.rose.950", colors.rose[950]),
                        ),
                        "1": theme(
                            "colors.rose.dark.1",
                            theme("colors.rose.900", colors.rose[900]),
                        ),
                        "2": theme(
                            "colors.rose.dark.2",
                            theme("colors.rose.800", colors.rose[800]),
                        ),
                        "3": theme(
                            "colors.rose.dark.3",
                            theme("colors.rose.700", colors.rose[700]),
                        ),
                        "4": theme(
                            "colors.rose.dark.4",
                            theme("colors.rose.600", colors.rose[600]),
                        ),
                    },
                };
                break;
            default:
                color = {};
        }

        return color;
    }

    protected addColor(name: string, variants: ColorVariants): this {
        Object.entries(variants).forEach((color) => {
            const scheme = color[0];
            const value = color[1];
            if (typeof value === "string") {
                this.addColorValue(name, value);
            } else {
                this.matchColorValues(`${name}-${scheme}`, variants[scheme]);
            }
        });

        return this.matchColorScheme(name, variants);
    }

    protected matchColorScheme(name: string, variants: ColorVariants): this {
        const lightColor = variants.light;
        const darkColor = variants.dark;

        if (lightColor !== undefined) {
            this.addComponents(
                this.stylizeColorSchemeComponent(name, lightColor, darkColor),
            );
            this.addUtilities(
                this.stylizeColorSchemeUtility(name, lightColor, darkColor),
            );
        }

        return this;
    }

    protected matchColorValues(name: string, values: ColorValues): this {
        return this.matchColorComponents(name, values).matchColorUtilities(
            name,
            values,
        );
    }

    protected addColorValue(name: string, value: ColorValue): this {
        return this.addColorComponents(name, value).addColorUtilities(
            name,
            value,
        );
    }

    protected addColorComponents(name: string, value: ColorValue): this {
        return this.addComponents(this.stylizeComponents(name, value));
    }

    protected matchColorComponents(name: string, values: ColorValues): this {
        return this.matchComponents(
            this.stylizeComponentsCallback(name),
            values,
        );
    }

    protected addColorUtilities(name: string, value: ColorValue): this {
        return this.addUtilities(this.stylizeColorUtility(name, value));
    }

    protected matchColorUtilities(name: string, values: ColorValues): this {
        return this.matchUtilities(
            this.stylizeColorUtilityCallback(name),
            values,
        );
    }

    protected stylizeColorSchemeComponent(
        variant: string,
        lightValues: ColorValues,
        darkValues: ColorValues | undefined = undefined,
    ): RuleSet[] {
        const { e } = this.api;
        const style: RuleSet[] = [];
        Object.entries(this.components).forEach((component) => {
            const name = `${component[0]}-${variant}`;
            const utilities = component[1];

            Object.entries(lightValues).forEach((color) => {
                const colorKey = color[0];
                const colorName = `${name}-${colorKey}`;
                const colorValue = color[1];
                if (typeof utilities === "string") {
                    style.push(
                        darken_class(
                            this.darkMode,
                            colorName,
                            this.stylizeUtility(utilities, colorValue),
                            darkValues === undefined
                                ? undefined
                                : stylize_property(
                                      utilities,
                                      darkValues[colorKey],
                                  ),
                        ),
                    );
                } else if (utilities instanceof Array) {
                    style.push(
                        darken_class(
                            this.darkMode,
                            colorName,
                            this.stylizeUtilities(utilities, colorValue),
                            darkValues === undefined
                                ? undefined
                                : this.stylizeUtilities(
                                      utilities,
                                      darkValues[colorKey],
                                  ),
                        ),
                    );
                } else {
                    Object.entries(utilities).forEach((utility) => {
                        const utilityName =
                            utility[0] === "DEFAULT"
                                ? colorName
                                : `${colorName}-${e(utility[0])}`;
                        const properties = utility[1];
                        if (typeof properties === "string") {
                            style.push(
                                darken_class(
                                    this.darkMode,
                                    utilityName,
                                    this.stylizeUtility(properties, colorValue),
                                    darkValues === undefined
                                        ? undefined
                                        : this.stylizeUtility(
                                              properties,
                                              darkValues[colorKey],
                                          ),
                                ),
                            );
                        } else {
                            style.push(
                                darken_class(
                                    this.darkMode,
                                    utilityName,
                                    this.stylizeUtilities(
                                        properties,
                                        colorValue,
                                    ),
                                    darkValues === undefined
                                        ? undefined
                                        : this.stylizeUtilities(
                                              properties,
                                              darkValues[colorKey],
                                          ),
                                ),
                            );
                        }
                    });
                }
            });
        });
        return style;
    }

    protected stylizeColorSchemeUtility(
        variant: string,
        lightValues: ColorValues,
        darkValues: ColorValues | undefined = undefined,
    ): RuleSet[] {
        const style: RuleSet[] = [];
        Object.entries(this.utilities).forEach((utility) => {
            const utilityName = `${utility[0]}-${variant}`;
            const propertyName = utility[1];
            Object.entries(lightValues).forEach((color) => {
                const colorKey = color[0];
                const colorValue = color[1];
                style.push(
                    darken_class(
                        this.darkMode,
                        `${utilityName}-${colorKey}`,
                        stylize_property(propertyName, colorValue),
                        darkValues === undefined
                            ? undefined
                            : stylize_property(
                                  propertyName,
                                  darkValues[colorKey],
                              ),
                    ),
                );
            });
        });
        return style;
    }

    protected stylizeColorUtility(name: string, value: ColorValue): RuleSet {
        const { e } = this.api;
        let rules: RuleSet = {};

        Object.entries(this.utilities).forEach((utility) => {
            const utilityName = `${utility[0]}-${e(name)}`;
            const propertyName = utility[1];
            rules = append_style(
                stylize_class(utilityName, {
                    [propertyName]: value,
                }),
                rules,
            );
        });
        return rules;
    }

    protected stylizeColorUtilityCallback(name: string): StyleCallbacks {
        const { e } = this.api;
        const rules: StyleCallbacks = {};

        Object.entries(this.utilities).forEach((utility) => {
            const utilityName = utility[0];
            const propertyName = utility[1];
            rules[`${utilityName}-${e(name)}`] = (value) =>
                stylize_property(propertyName, value);
        });
        return rules;
    }
}
