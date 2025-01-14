import type { PluginCreator, PluginCreatorWithOptions } from "plugwind.js";
import * as Plugger from "./plugger";
import type { ClassName } from "./styles";

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

export const UI: PluginCreatorWithOptions<UIOptions> = Plugger.plugUI();
export const UIColors: PluginCreator = Plugger.plugColors();
export const UILinks: PluginCreatorWithOptions<LinkOptions> =
  Plugger.plugLinks();
export const UIEdges: PluginCreatorWithOptions<EdgeOptions> =
  Plugger.plugEdges();

export default UI;
