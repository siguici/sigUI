import { PluginAPI } from "tailwindcss/types/config";
import { ComponentList, UtilityList } from "../types";

export interface PluginContract<T> {
    readonly api: PluginAPI;
    readonly options: T;
    readonly components: ComponentList;
    readonly utilities: UtilityList;
    create(): this;
}
