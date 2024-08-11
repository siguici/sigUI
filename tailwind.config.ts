import type { Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";
import { UI } from "./plugin";

export const UIConfig: Config = {
  content: [
    "./config/ui.php",
    "./src/Components/**/*.php",
    "./resources/views/**/*.blade.php",
  ],

  theme: {
    extend: {
      sans: [...defaultTheme.fontFamily.sans],
    },
  },

  plugins: [UI],
};

export default UIConfig;
