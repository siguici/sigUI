import { type Alpine } from "alpinejs";

export {};

declare global {
    interface Window {
        Alpine: Alpine;
    }
}
