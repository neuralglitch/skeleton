import './bootstrap.js';
// Stimulus
import './bootstrap.js'

import * as bootstrap from "bootstrap";
window.bootstrap = bootstrap;

function initOverlays(root = document) {
  root.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
    if (!bootstrap.Tooltip.getInstance(el)) bootstrap.Tooltip.getOrCreateInstance(el);
  });
  root.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
    if (!bootstrap.Popover.getInstance(el)) bootstrap.Popover.getOrCreateInstance(el);
  });
}

function disposeOverlays(root = document) {
  root.querySelectorAll('[data-bs-toggle="tooltip"]').forEach((el) => {
    bootstrap.Tooltip.getInstance(el)?.dispose?.();
  });
  root.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
    bootstrap.Popover.getInstance(el)?.dispose?.();
  });
}

// Klassisch
document.addEventListener("DOMContentLoaded", () => initOverlays());

// Turbo (falls aktiv)
document.addEventListener("turbo:load", () => initOverlays());
document.addEventListener("turbo:before-cache", () => disposeOverlays());
