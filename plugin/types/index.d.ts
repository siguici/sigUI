import type { ClassName } from "./styles";
import type { Config, PluginCreator } from "tailwindcss/types/config";

export type PluginWithoutOptions =
    | PluginCreator
    | {
          handler: PluginCreator;
          config?: Partial<Config>;
      };
export type PluginWithOptions<T> = {
    (options: T): {
        handler: PluginCreator;
        config?: Partial<Config> | undefined;
    };
    __isOptionsFunction: true;
};

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
