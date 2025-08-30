import "./bootstrap";
import "./generalSidebarNav";

import $ from "jquery";
window.$ = $;
window.jQuery = $;

import "./storeComments";
import "./postPerCat";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
