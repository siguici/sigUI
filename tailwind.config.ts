import { UI } from "./plugins/tailwindcss";
import { Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";

export const UIConfig: Config = {
    content: [
        "./config/ui.php",
        "./src/Components/**/*.php",
        "./res/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            sans: [...defaultTheme.fontFamily.sans],
        },
    },

    plugins: [UI],
};

export default UIConfig;
