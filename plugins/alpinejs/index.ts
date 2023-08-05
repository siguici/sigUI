import dropdown from "./dropdown";
import swap from "./swap";
import type { Alpine } from "alpinejs";

export default function (alpine: Alpine) {
    alpine.data("dropdown", (status = false) => dropdown(status as boolean));
    alpine.data("swap", (status = false) => swap(status as boolean));
}
