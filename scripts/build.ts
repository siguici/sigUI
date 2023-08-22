import brotliSize, { sync } from "brotli-size";
import esbuild from "esbuild";
import fs from "node:fs";

build("index.js");

build("index.cjs.js", "cjs");

build("index.esm.js", "esm");

build("index.min.js", undefined, true);

async function build(
    dist: string,
    format: "iife" | "cjs" | "esm" | undefined = undefined,
    minify = false,
) {
    const watch = process.argv.includes("--watch");
    const outfile = `dist/${dist}`;

    const options = {
        entryPoints: ["plugin/index.js"],
        platform: "node",
        bundle: true,
        outfile,
        format,
        minify,
        define: { CDN: "true" },
    };

    options.define["process.env.NODE_ENV"] = watch
        ? `'development'`
        : `'production'`;

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

    console.log("\x1b[32m", `Bundle size: ${size}`);
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
