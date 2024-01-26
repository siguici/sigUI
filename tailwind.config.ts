import styliz from "styliz";
import { Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";

export const UIConfig: Config = {
  content: ["./design/**/*.{html,css,ts}"],

  theme: {
    extend: {
      sans: [...defaultTheme.fontFamily.sans],
    },
  },

  plugins: [styliz],
};

export default UIConfig;
