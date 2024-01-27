import sitemap from "@astrojs/sitemap";
import starlight from "@astrojs/starlight";
import tailwind from "@astrojs/tailwind";
import { defineConfig } from "astro/config";

// https://astro.build/config
export default defineConfig({
  site: "https://siguici.github.io/styliz",
  compressHTML: true,
  integrations: [
    starlight({
      title: "Styliz",
      social: {
        github: "https://github.com/siguici/styliz",
      },
      editLink: {
        baseUrl: "https://github.com/siguici/styliz/edit/main/website/",
      },
      sidebar: [
        {
          label: "Home",
          link: "/",
        },
        {
          label: "Getting started",
          items: [{ label: "Quickstart", link: "/start/" }],
        },
        {
          label: "Guides",
          items: [{ label: "Guides", link: "/guides/" }],
        },
        {
          label: "Reference",
          autogenerate: { directory: "reference" },
        },
      ],
      customCss: ["./src/design/global.css"],
    }),
    tailwind({
      applyBaseStyles: false,
    }),
    sitemap({
      changefreq: "daily",
      priority: 0.8,
      lastmod: new Date(),
      i18n: {
        defaultLocale: "en",
        locales: {
          en: "en-US",
        },
      },
    }),
  ],
});
