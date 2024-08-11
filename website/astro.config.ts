import starlight from "@astrojs/starlight";
import tailwind from "@astrojs/tailwind";
import qwikdev from "@qwikdev/astro";
import { defineConfig } from "astro/config";

// https://astro.build/config
export default defineConfig({
  site: "https://sikessem.github.io",
  base: "/ui",
  integrations: [
    starlight({
      favicon: "/favicon.ico",
      logo: {
        src: "./src/assets/logo.svg",
        alt: "Sikessem",
        replacesTitle: true,
      },
      title: "Sikessem",
      editLink: {
        baseUrl:
          "https://github.com/sikessem/ui/edit/0.x/website/src/content/docs/",
      },
      social: {
        github: "https://github.com/sikessem/ui",
        twitter: "https://twitter.com/@sikessem_news",
      },
      locales: {
        root: {
          label: "English",
          lang: "en",
        },
        fr: {
          label: "Français",
        },
      },
      sidebar: [
        {
          label: "Projects",
          translations: {
            fr: "Projets",
          },
          autogenerate: {
            directory: "projects",
          },
        },
        {
          label: "Packages",
          autogenerate: {
            directory: "packages",
          },
        },
        {
          label: "🧪 Testing and Debugging",
          translations: {
            fr: "Test et Débogage",
          },
          link: "testing",
        },
        {
          label: "👥 Contribution Guide",
          translations: {
            fr: "👥 Guide de Contribution",
          },
          link: "contributions",
        },
        {
          label: "🛂 Code of Conduct",
          translations: {
            fr: "🛂 Code de Conduite",
          },
          link: "code-of-conduct",
        },
      ],
      customCss: ["./src/designs/global.css"],
    }),
    tailwind({
      applyBaseStyles: false,
    }),
    qwikdev(),
  ],
  // Process images with sharp: https://docs.astro.build/en/guides/assets/#using-sharp
  image: {
    service: {
      entrypoint: "astro/assets/services/sharp",
    },
  },
});
