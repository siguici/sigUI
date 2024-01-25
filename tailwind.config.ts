import { Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";
import { UI } from "./src";

export const UIConfig: Config = {
  content: ["./design/**/*.{html,css,ts}"],

  theme: {
    extend: {
      sans: [...defaultTheme.fontFamily.sans],
    },
  },

  plugins: [UI],
};

export default UIConfig;
