import { UIPlugin } from "../plugins/tailwindcss";
import UIConfig from "../tailwind.config";
import path from "node:path";
import postcss from "postcss";
import tailwindcss, { type Config } from "tailwindcss";
import resolveConfig from "tailwindcss/resolveConfig";

import { describe, expect, it } from "vitest";

const html = String.raw;
const css = String.raw;

function run(
    config: Config,
    input = "@tailwind utilities",
    plugin = tailwindcss,
) {
    const { currentTestName } = expect.getState();
    const fullConfig = resolveConfig({
        presets: [UIConfig],
        plugins: [UIPlugin],
        corePlugins: { preflight: false },
        ...config,
    });

    return postcss(plugin(fullConfig)).process(input, {
        from: `${path.resolve(__filename)}?test=${currentTestName}`,
    });
}

describe.concurrent("suite", () => {
    const config = {
        content: [
            {
                raw: html`<div class="link-red bg-red-light-0 border-red-dark-0"></div>`,
            },
        ],
    };

    it("should have red link class", async () => {
        return run(config, "@tailwind components").then((result) => {
            expect(result.css).toContain(css`.link-red`);
        });
    });

    it("should have dark red color class", async () => {
        return run(config).then((result) => {
            expect(result.css).toContain(css`.bg-red-light-0`);
        });
    });

    it("should have light red color", async () => {
        return run(config).then((result) => {
            expect(result.css).toContain(css`.border-red-dark-0`);
        });
    });
});
