import type {
  EdgeOptions,
  LinkOptions,
  RequiredEdgeOptions,
  RequiredLinkOptions,
  RequiredUIOptions,
  UIOptions,
} from ".";

import _plug, {
  type Plug,
  type Plugin,
  type PluginAPI,
  type PluginCreator,
  type PluginCreatorWithOptions,
  type PluginWithOptions,
} from "plugwind.js";
import { Colors } from "./colors";
import { Edges } from "./edges";
import { Links } from "./links";

export const DEFAULT_OPTIONS: RequiredUIOptions = {
  linkClass: "link",
  entryClass: "entry",
  buttonClass: "button",
};

export function plugUI(): PluginCreatorWithOptions<UIOptions> {
  return plug.with(
    (options: UIOptions = DEFAULT_OPTIONS) =>
      (api: PluginAPI) => {
        useColors(api);
        useLinks(api, {
          linkClass: options.linkClass || DEFAULT_OPTIONS.linkClass,
        });
        useEdges(api, {
          entryClass: options.entryClass || DEFAULT_OPTIONS.entryClass,
          buttonClass: options.buttonClass || DEFAULT_OPTIONS.buttonClass,
        });
      },
  );
}

const isPlug = (plug: unknown): plug is Plug => {
  return (
    typeof plug === "function" && typeof (plug as Plug).with === "function"
  );
};

const toPlug = (plug: unknown): Plug => {
  if (isPlug(plug)) {
    return plug;
  }

  const plugWithMethod: Plug = Object.assign(
    (plugin: Plugin): PluginCreator => {
      if (typeof plug !== "function") {
        throw new Error("Invalid plug type");
      }
      return plug(plugin);
    },
    {
      with<T>(plugin: PluginWithOptions<T>): PluginCreatorWithOptions<T> {
        if (isPlug(plug)) {
          return plug.with(plugin);
        }
        throw new Error("Invalid plug type");
      },
    },
  );

  return plugWithMethod;
};

const plug: Plug = toPlug(_plug);

export function plugColors(): PluginCreator {
  return plug((api: PluginAPI) => useColors(api));
}

export function plugLinks(): PluginCreatorWithOptions<LinkOptions> {
  return plug.with(
    (
      options: LinkOptions = {
        linkClass: DEFAULT_OPTIONS.linkClass,
      },
    ) =>
      (api: PluginAPI) =>
        useLinks(api, options as RequiredLinkOptions),
  );
}

export function plugEdges(): PluginCreatorWithOptions<EdgeOptions> {
  return plug.with(
    (
      options: EdgeOptions = {
        entryClass: DEFAULT_OPTIONS.entryClass,
        buttonClass: DEFAULT_OPTIONS.buttonClass,
      },
    ) =>
      (api: PluginAPI) => {
        const plugin = new Edges(api, options as RequiredEdgeOptions);
        return plugin.create();
      },
  );
}

function useColors(api: PluginAPI): Colors {
  return new Colors(api).create();
}

function useLinks(api: PluginAPI, options: RequiredLinkOptions): Links {
  return new Links(api, options as RequiredLinkOptions).create();
}

function useEdges(api: PluginAPI, options: RequiredEdgeOptions): Edges {
  return new Edges(api, options as RequiredEdgeOptions).create();
}
