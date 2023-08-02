import { UI as UIPlugin } from "../plugins/tailwindcss";
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
    input = "@tailwind base;@tailwind components;@tailwind utilities",
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
                raw: html`<div class="text-red bg-red-0 border-red-4"></div>`,
            },
        ],
    };

    it("should have red text class", async () => {
        return run(config).then((result) => {
            expect(result.css).toContain(css`.text-red`);
        });
    });

    it("should have bg-red-0 class", async () => {
        return run(config).then((result) => {
            expect(result.css).toContain(css`.bg-red-0`);
        });
    });

    it("should have border-red-4 class", async () => {
        return run(config).then((result) => {
            expect(result.css).toContain(css`.border-red-4`);
        });
    });
});
