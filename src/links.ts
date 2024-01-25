import { ComponentList, RequiredLinkOptions, UtilityList } from "../types";
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
