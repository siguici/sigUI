import type { ClassName, RequiredUIOptions, UIOptions } from "./types";

import { ColorPlugin } from "./ColorPlugin";
import type { PluggerContract } from "./Contracts/Plugger";
import type { PluginContract } from "./Contracts/Plugin";
import { LinkPlugin } from "./LinkPlugin";
import type { PluginAPI } from "tailwindcss/types/config";

export class Plugger implements PluggerContract {
    static DEFAULT_OPTIONS: RequiredUIOptions = {
        linkClass: "link",
    };

    constructor(protected api: PluginAPI) {}

    boot(options: UIOptions = undefined): this {
        const pluginOptions = options || Plugger.DEFAULT_OPTIONS;

        return this.plugColors().plugLinks(
            pluginOptions.linkClass || Plugger.DEFAULT_OPTIONS.linkClass,
        );
    }

    plugColors(): this {
        const plugin = new ColorPlugin(this.api);
        return this.plug(plugin);
    }

    plugLinks(className: ClassName): this {
        const plugin = new LinkPlugin(this.api, className);
        return this.plug(plugin);
    }

    plug(plugin: PluginContract): this {
        plugin.build();
        return this;
    }
}

export default Plugger;
