import { PluginAPI } from "tailwindcss/types/config";
import { Plugin } from "./Plugin";
import { ClassName } from "./types";

export class LinkPlugin extends Plugin
{
    constructor(api: PluginAPI, readonly className: ClassName) {
        super(api);
    }

    public build() {
        this.addComponents({
            [this.className]: {
                "&:hover": {
                    textDecoration: "underline",
                },
            },
        });
    }
}
