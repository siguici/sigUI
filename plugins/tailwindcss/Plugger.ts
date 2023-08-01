import type {
    RequiredUIOptions, UIOptions,
} from "./types";

import type { PluginAPI } from "tailwindcss/types/config";
import type { PluggerContract } from "./Contracts/Plugger";
import type { PluginContract } from "./Contracts/Plugin";
import { Plugin } from "./Plugin";
import { LinkPlugin } from "./LinkPlugin";
import { ColorPlugin } from "./ColorPlugin";

export class Plugger implements PluggerContract {
    static DEFAULT_OPTIONS: RequiredUIOptions = {
        useColors: true,
        linksClass: 'link',
    };

    plugins: PluginContract[] = [];

    constructor(protected api: PluginAPI) {}

    boot(options : UIOptions = undefined): this
    {
        const plugOptions = options || Plugger.DEFAULT_OPTIONS;
        
        if (plugOptions.useColors) {
            this.plugColors();
        }

        if (plugOptions.linksClass !== undefined) {
            this.plugLinks(plugOptions.linksClass);
        }

        return this;
    }

    plugColors(): this
    {
        const plugin = new ColorPlugin(this.api);
        return this.plug(plugin);
    }

    plugLinks(className: string = Plugger.DEFAULT_OPTIONS.linksClass): this
    {
        const plugin = new LinkPlugin(this.api, className);
        return this.plug(plugin);
    }

    plug(plugin: PluginContract): this
    {
        if (! this.plugins.find(p => p.toString() === plugin.toString())) {
            this.plugins.push(plugin);
        }
        plugin.build();
        return this;
    }
}

export default Plugger;
