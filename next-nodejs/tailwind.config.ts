import type { Config } from "tailwindcss";

const config: Config = {
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      backgroundImage: {
        "gradient-radial": "radial-gradient(var(--tw-gradient-stops))",
        "gradient-conic":
          "conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))",
      },
      colors: {
        "primary-50": "#fff",
        "primary-100": "#f4f9fd",
        "primary-200": "#c7e3f7",
        "primary-300": "#9acdf1",
        "primary-400": "#6eb6ea",
        "primary-500": "#41a0e4",
        "primary-600": "#1e88d4",
        "primary-800": "#186ba7",
        "primary-700": "#114f7b",
        "primary-900": "#0b324e",
        "primary-950": "#051521",
      },
    },
  },
  plugins: [],
};
export default config;
