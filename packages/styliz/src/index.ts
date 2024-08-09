import plugin from "tailwindcss/plugin";
import type { PluginAPI } from "tailwindcss/types/config";
import { Colors } from "./colors";
import { type EdgeOptions, Edges, type RequiredEdgeOptions } from "./edges";
import { type LinkOptions, Links, type RequiredLinkOptions } from "./links";
import type { PluginWithOptions, PluginWithoutOptions } from "./plugin";

export type RequiredStylizOptions = RequiredLinkOptions & RequiredEdgeOptions;

export type StylizOptions = Partial<RequiredStylizOptions> | undefined;

export const DEFAULT_OPTIONS: RequiredStylizOptions = {
  linkClass: "link",
  entryClass: "entry",
  buttonClass: "button",
};

export function plugStyliz(): PluginWithOptions<StylizOptions> {
  return plugin.withOptions(
    (options: StylizOptions = DEFAULT_OPTIONS) =>
      (api) => {
        useColors(api);
        useLinks(api, {
          linkClass: options.linkClass || DEFAULT_OPTIONS.linkClass,
        });
        useEdges(api, {
          entryClass: options.entryClass || DEFAULT_OPTIONS.entryClass,
          buttonClass: options.buttonClass || DEFAULT_OPTIONS.buttonClass,
        });
      },
  );
}

export function plugColors(): PluginWithoutOptions {
  return plugin(useColors);
}

export function plugLinks(): PluginWithOptions<LinkOptions> {
  return plugin.withOptions(
    (
      options: LinkOptions = {
        linkClass: DEFAULT_OPTIONS.linkClass,
      },
    ) =>
      (api) =>
        useLinks(api, options as RequiredLinkOptions),
  );
}

export function plugEdges(): PluginWithOptions<EdgeOptions> {
  return plugin.withOptions(
    (
      options: EdgeOptions = {
        entryClass: DEFAULT_OPTIONS.entryClass,
        buttonClass: DEFAULT_OPTIONS.buttonClass,
      },
    ) =>
      (api) => {
        return new Edges(api, options as RequiredEdgeOptions).create();
      },
  );
}

function useColors(api: PluginAPI): Colors {
  return new Colors(api).create();
}

function useLinks(api: PluginAPI, options: RequiredLinkOptions): Links {
  return new Links(api, options as RequiredLinkOptions).create();
}

function useEdges(api: PluginAPI, options: RequiredEdgeOptions): Edges {
  return new Edges(api, options as RequiredEdgeOptions).create();
}

export const colors = plugColors();
export const links = plugLinks();
export const edges = plugEdges();

export default plugStyliz();
