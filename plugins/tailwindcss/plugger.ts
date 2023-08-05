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

import { Colors } from "./colors";
import { Edges } from "./edges";
import { Links } from "./links";
import plugin from "tailwindcss/plugin";
import { PluginAPI } from "tailwindcss/types/config";

export class Plugger {
    static DEFAULT_OPTIONS: RequiredUIOptions = {
        linkClass: "link",
        entryClass: "entry",
        buttonClass: "button",
    };

    static plugUI(): PluginWithOptions<UIOptions> {
        return plugin.withOptions(
            (options: UIOptions = Plugger.DEFAULT_OPTIONS) => (api) => {
                this.useColors(api);
                this.useLinks(api, {
                    linkClass:
                        options.linkClass || Plugger.DEFAULT_OPTIONS.linkClass,
                });
                this.useEdges(api, {
                    entryClass:
                        options.entryClass ||
                        Plugger.DEFAULT_OPTIONS.entryClass,
                    buttonClass:
                        options.buttonClass ||
                        Plugger.DEFAULT_OPTIONS.buttonClass,
                });
            },
        );
    }

    static plugColors(): PluginWithoutOptions {
        return plugin((api) => this.useColors(api));
    }

    static plugLinks(): PluginWithOptions<LinkOptions> {
        return plugin.withOptions(
            (
                    options: LinkOptions = {
                        linkClass: Plugger.DEFAULT_OPTIONS.linkClass,
                    },
                ) =>
                (api) =>
                    this.useLinks(api, options as RequiredLinkOptions),
        );
    }

    static plugEdges(): PluginWithOptions<EdgeOptions> {
        return plugin.withOptions(
            (
                    options: EdgeOptions = {
                        entryClass: Plugger.DEFAULT_OPTIONS.entryClass,
                        buttonClass: Plugger.DEFAULT_OPTIONS.buttonClass,
                    },
                ) =>
                (api) => {
                    const plugin = new Edges(
                        api,
                        options as RequiredEdgeOptions,
                    );
                    return plugin.create();
                },
        );
    }

    protected static useColors(api: PluginAPI): Colors {
        return new Colors(api).create();
    }

    protected static useLinks(
        api: PluginAPI,
        options: RequiredLinkOptions,
    ): Links {
        return new Links(api, options as RequiredLinkOptions).create();
    }

    protected static useEdges(
        api: PluginAPI,
        options: RequiredEdgeOptions,
    ): Edges {
        return new Edges(api, options as RequiredEdgeOptions).create();
    }
}

export default Plugger;
