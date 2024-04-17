import type { Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";
import { UI } from "./plugin";

export const UIConfig: Config = {
  content: [
    "./config/ui.php",
    "./src/Components/**/*.php",
    "./res/views/**/*.blade.php",
    "./design/**/*.{html,css,ts}",
  ],

  theme: {
    extend: {
      sans: [...defaultTheme.fontFamily.sans],
    },
  },

  plugins: [UI],
};

export default UIConfig;
