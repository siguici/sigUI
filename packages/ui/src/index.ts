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

export const UI = Plugger.plugUI();
export const UIColors = Plugger.plugColors();
export const UILinks = Plugger.plugLinks();
export const UIEdges = Plugger.plugEdges();

export default UI;
