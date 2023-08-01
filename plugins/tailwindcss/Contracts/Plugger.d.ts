import { UIOptions } from "../types";
import { PluginContract } from "./Plugin";

export interface PluggerContract {
    plugins: PluginContract[];
    boot(options: UIOptions): void;
    plug(plugin: PluginContract): this;
}
