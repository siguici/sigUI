import type * as Styles from "./styles";

export type RequiredUIOptions = {
    linkClass: Styles.ClassName;
};

export type UIOptions = Partial<RequiredUIOptions> | undefined;

declare function plugin(options?: UIOptions): { handler: () => void };

declare namespace plugin {
    const __isOptionsFunction: true;
}

export type DarkModeStrategy = "class" | "media";
export type DarkModeQuery = string;
export type DarkMode = [DarkModeStrategy, DarkModeQuery];

export * from "./styles";
export * from "./colors";

export default plugin;
