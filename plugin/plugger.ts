import type {
    EdgeOptions,
    LinkOptions,
    PluginWithOptions,
    PluginWithoutOptions,
    RequiredEdgeOptions,
    RequiredLinkOptions,
    RequiredUIOptions,
    UIOptions,
} from "./types";

import plugin from "tailwindcss/plugin";
import { PluginAPI } from "tailwindcss/types/config";
import { Colors } from "./colors";
import { Edges } from "./edges";
import { Links } from "./links";

export const DEFAULT_OPTIONS: RequiredUIOptions = {
    linkClass: "link",
    entryClass: "entry",
    buttonClass: "button",
};

export function plugUI(): PluginWithOptions<UIOptions> {
    return plugin.withOptions((options: UIOptions = DEFAULT_OPTIONS) =>
        (api) => {
            useColors(api);
            useLinks(api, {
                linkClass: options.linkClass || DEFAULT_OPTIONS.linkClass,
            });
            useEdges(api, {
                entryClass: options.entryClass || DEFAULT_OPTIONS.entryClass,
                buttonClass: options.buttonClass || DEFAULT_OPTIONS.buttonClass,
            });
        });
}

export function plugColors(): PluginWithoutOptions {
    return plugin((api) => useColors(api));
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
                const plugin = new Edges(api, options as RequiredEdgeOptions);
                return plugin.create();
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
