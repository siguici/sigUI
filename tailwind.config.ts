import ui from "./plugins/tailwindcss";
import aspectRadio from "@tailwindcss/aspect-ratio";
import containerQueries from "@tailwindcss/container-queries";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
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

    plugins: [aspectRadio, containerQueries, forms, typography, ui],
};

export default UIConfig;
