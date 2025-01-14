import type { PluginAPI } from "tailwindcss/types/config";
import type { ComponentList, UtilityList } from ".";

export interface PluginContract<T> {
  readonly api: PluginAPI;
  readonly options: T;
  readonly components: ComponentList;
  readonly utilities: UtilityList;
  create(): this;
}
