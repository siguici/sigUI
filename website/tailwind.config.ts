import starlightPlugin from "@astrojs/starlight-tailwind";
import type { Config } from "tailwindcss";
import colors from "tailwindcss/colors";
import defaultTheme from "tailwindcss/defaultTheme";

export const TailwindConfig: Config = {
  content: ["./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}"],
  theme: {
    extend: {
      sans: [...defaultTheme.fontFamily.sans],
      colors: {
        // Your preferred accent color. Indigo is closest to Starlight’s defaults.
        accent: colors.indigo,
        // Your preferred gray scale. Zinc is closest to Starlight’s defaults.
        gray: colors.zinc,
      },
    },
  },
  plugins: [starlightPlugin()],
};

export default TailwindConfig;
