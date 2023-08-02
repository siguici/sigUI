import { Plugin } from "./Plugin";
import { RequiredLinkOptions } from "./types";
import { PluginAPI } from "tailwindcss/types/config";

export class LinkPlugin extends Plugin<RequiredLinkOptions> {
    public create(): this {
        return this.addComponents({
            [this.options.linkClass]: {
                "&:hover": {
                    textDecoration: "underline",
                },
            },
        });
    }
}
