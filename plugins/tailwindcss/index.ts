import Plugger from "./Plugger";
import { UIOptions } from "./types";
import plugin from "tailwindcss/plugin";
import type { PluginAPI } from "tailwindcss/types/config";

export const UIPlugin = plugin.withOptions((options: UIOptions = undefined) =>
    (api: PluginAPI) => {
        const plugger = new Plugger(api);
        plugger.boot(options);
    });

export default UIPlugin;
