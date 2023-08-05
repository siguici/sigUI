import ui from "../../plugins/alpinejs";
import "./ui.css";
import Alpine from "alpinejs";

window.Alpine = Alpine;
Alpine.plugin(ui);
Alpine.start();
