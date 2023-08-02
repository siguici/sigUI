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

import { ColorPlugin } from "./ColorPlugin";
import { EdgePlugin } from "./EdgePlugin";
import { LinkPlugin } from "./LinkPlugin";
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
                    const plugin = new EdgePlugin(
                        api,
                        options as RequiredEdgeOptions,
                    );
                    return plugin.create();
                },
        );
    }

    protected static useColors(api: PluginAPI): ColorPlugin {
        return new ColorPlugin(api).create();
    }

    protected static useLinks(
        api: PluginAPI,
        options: RequiredLinkOptions,
    ): LinkPlugin {
        return new LinkPlugin(api, options as RequiredLinkOptions).create();
    }

    protected static useEdges(
        api: PluginAPI,
        options: RequiredEdgeOptions,
    ): EdgePlugin {
        return new EdgePlugin(api, options as RequiredEdgeOptions).create();
    }
}

export default Plugger;
