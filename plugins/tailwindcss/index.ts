import type { PluggerOptions } from "../../types";
import Plugger from "./Plugger";
import plugin from "tailwindcss/plugin";
import type { PluginAPI } from "tailwindcss/types/config";

export const UIPlugin = plugin.withOptions((options: PluggerOptions = {}) =>
    (api: PluginAPI) => {
        const plugger = new Plugger(api, options);
        plugger.plug();
    });

export default UIPlugin;
