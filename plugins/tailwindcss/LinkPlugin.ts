import { Plugin } from "./Plugin";
import { ClassName } from "./types";
import { PluginAPI } from "tailwindcss/types/config";

export class LinkPlugin extends Plugin {
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
