import type { ComponentList, RequiredLinkOptions, UtilityList } from ".";
import { Plugin } from "./plugin";

export class Links extends Plugin<RequiredLinkOptions> {
  readonly components: ComponentList = {};
  readonly utilities: UtilityList = {};
  public create(): this {
    const { e } = this.api;
    return this.addComponents({
      [`.${e(this.options.linkClass)}`]: {
        "&:hover": {
          textDecoration: "underline",
        },
      },
    });
  }
}
