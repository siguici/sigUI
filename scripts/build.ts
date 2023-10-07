import fs from "node:fs";
import { basename, extname } from "node:path";
import brotliSize from "brotli-size";
import esbuild from "esbuild";

build("index.js", undefined, false);

build("index.cjs", "cjs");

build("index.cjs", "cjs", true);

build("index.mjs", "esm");

build("index.mjs", "esm", true);

build("index.min.js", undefined, false, true);

async function build(
    dist: string,
    format: "iife" | "cjs" | "esm" | undefined = undefined,
    prod = false,
    minify = false,
) {
    const watch = process.argv.includes("--watch");
    const entryPoints = ["plugin/index.js"];
    const distext = extname(dist);
    const outfile = `dist/${
        prod ? `${basename(dist, distext)}.prod${distext}` : dist
    }`;

    const options = {
        platform: "node",
        bundle: true,
        entryPoints,
        outfile,
        format,
        minify,
        define: { CDN: "true" },
    };

    options.define["process.env.NODE_ENV"] =
        watch || !prod ? `'development'` : `'production'`;

    return (
        watch
            ? esbuild.context(options).then((ctx) => ctx.watch())
            : esbuild.build(options)
    )
        .then(() => {
            outputSize(outfile);
        })
        .catch(() => process.exit(1));
}

function outputSize(file: string) {
    const size = bytesToSize(brotliSize.sync(fs.readFileSync(file)));

    console.log("\x1b[32m", `${file} bundle size: ${size}`);
}

function bytesToSize(bytes: number): string {
    const sizes = ["Bytes", "KB", "MB", "GB", "TB"];
    if (bytes === 0) {
        return "n/a";
    }
    const i = Math.floor(Math.log(bytes) / Math.log(1024));
    if (i === 0) {
        return `${bytes} ${sizes[i]}`;
    }
    return `${(bytes / 1024 ** i).toFixed(1)} ${sizes[i]}`;
}
