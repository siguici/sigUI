import plug, {
  type PluginAPI,
  type PluginCreator,
  type PluginCreatorWithOptions,
} from "plugwind.js";
import plugin, { type PluginOptions } from "./plugin";
import type { ClassName } from "./styles";

export * as config from "./config";

export interface RequiredLinkOptions {
  linkClass: ClassName;
}
export type LinkOptions = Partial<RequiredLinkOptions>;

export type RequiredEdgeOptions = {
  entryClass: ClassName;
  buttonClass: ClassName;
};
export type EdgeOptions = Partial<RequiredEdgeOptions>;

export type RequiredUIOptions = RequiredLinkOptions & RequiredEdgeOptions;

export type UIOptions = Partial<RequiredUIOptions> | undefined;

export type DarkModeStrategy = "class" | "media";
export type DarkModeQuery = string;
export type DarkMode = [DarkModeStrategy, DarkModeQuery];

export * from "./styles";
export * from "./colors";
export { plugin };

export const colorwind: PluginCreatorWithOptions<PluginOptions> = plug.with(
  (options) => (api: PluginAPI) => {
    return plugin(api, options);
  },
);

const _colorwind: PluginCreator = plug((api: PluginAPI) => {
  return plugin(api);
});

export default _colorwind;
