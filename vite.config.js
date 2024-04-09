// vite.config.js
import { defineConfig } from "vite";
import { resolve } from "path";

export default defineConfig({
    css: {
        postcss: resolve(__dirname, "./postcss.config.cjs"),
    },
});
