import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
  ],
  build: {
    rollupOptions: {
      output: {
        // Put font files into 'public/fonts' folder
        assetFileNames: (assetInfo) => {
          if (/\.(woff2?|ttf|eot|svg)$/.test(assetInfo.name)) {
            return "fonts/[name][extname]";
          }
          return assetInfo.name;
        },
      },
    },
  },
});
