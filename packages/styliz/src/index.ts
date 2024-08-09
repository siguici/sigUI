import plug, {
  type PluginAPI,
  type PluginCreatorWithOptions,
} from "plugwind.js";
import { Colors, type ColorsConfig, DEFAULT_COLORS } from "./colors";
import { type EdgeOptions, Edges, type RequiredEdgeOptions } from "./edges";
import { type LinkOptions, Links, type RequiredLinkOptions } from "./links";

export type StylizConfig = Partial<{
  colors: boolean | ColorsConfig;
}>;

export type RequiredStylizOptions = StylizConfig &
  RequiredLinkOptions &
  RequiredEdgeOptions;

export type StylizOptions = Partial<RequiredStylizOptions> | undefined;

export const DEFAULT_OPTIONS: RequiredStylizOptions = {
  colors: true,
  linkClass: "link",
  entryClass: "entry",
  buttonClass: "button",
};

export function plugStyliz(): PluginCreatorWithOptions<StylizOptions> {
  return plug.with((options: StylizOptions = DEFAULT_OPTIONS) => (api) => {
    if (options.colors) {
      useColors(
        api,
        typeof options.colors === "boolean" ? DEFAULT_COLORS : options.colors,
      );
    }
    useLinks(api, {
      linkClass: options.linkClass || DEFAULT_OPTIONS.linkClass,
    });
    useEdges(api, {
      entryClass: options.entryClass || DEFAULT_OPTIONS.entryClass,
      buttonClass: options.buttonClass || DEFAULT_OPTIONS.buttonClass,
    });
  });
}

export function plugLinks(): PluginCreatorWithOptions<LinkOptions> {
  return plug.with(
    (
      options: LinkOptions = {
        linkClass: DEFAULT_OPTIONS.linkClass,
      },
    ) =>
      (api) =>
        useLinks(api, options as RequiredLinkOptions),
  );
}

export function plugEdges(): PluginCreatorWithOptions<EdgeOptions> {
  return plug.with(
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

function useColors(api: PluginAPI, options: ColorsConfig): Colors {
  return new Colors(api, options).create();
}

function useLinks(api: PluginAPI, options: RequiredLinkOptions): Links {
  return new Links(api, options as RequiredLinkOptions).create();
}

function useEdges(api: PluginAPI, options: RequiredEdgeOptions): Edges {
  return new Edges(api, options as RequiredEdgeOptions).create();
}

export const links = plugLinks();
export const edges = plugEdges();

export default plugStyliz();
