import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    "./storage/framework/views/*.php",
    "./resources/views/**/*.blade.php",
    "./resources/views/**/*.php",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ["OpenSans", "sans-serif"],
        heading: ["OpenSansCondensed", "sans-serif"],
      },
      borderWidth: {
        1: "1px",
      },
      colors: {
        siteBlack: "var(--site-black)",
        siteWhite: "var(--site-white)",
        siteNavy: "var(--site-navy)",
        accent: "var(--accent)",
        accentHover: "var(--accent-hover)",
      },
      typography: {
        DEFAULT: {
          css: {
            fontSize: "16px",
            h1: { fontSize: "2.5rem" },
            h2: { fontSize: "2rem" },
            h3: { fontSize: "1.75rem" },
            h4: { fontSize: "1.5rem" },
            p: { fontSize: "1rem" },
            color: "var(--site-black)",
            a: {
              color: "var(--accent)",
              "&:hover": {
                color: "var(--accent-hover)",
              },
            },
            h1: { color: "var(--site-navy)" },
            h2: { color: "var(--site-navy)" },
            strong: { color: "var(--site-black)" },
          },
        },
      },
      maxWidth: {
        1200: "1200px",
      },
      height: {
        "90dvh": "90dvh",
      },
    },
  },

  plugins: [forms, require("@tailwindcss/typography")],
};
