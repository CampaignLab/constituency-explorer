/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter", "sans-serif"],
            },
            colors: {
                "primary-background": "#F8FAFC",
                "primary-border": "#E2E8F0",
                "primary-blue": "#0973DC",
                "primary-blue-background": "#D3E0FD",
                "muted-foreground": "#64748B",
                "primary-slate": "#E2E8F0",
                "primary-light-blue-background": "#F0F8FF",
                scale: {
                    20: "#DBE9F6",
                    40: "#A3C7E8",
                    60: "#6497C4",
                    80: "#326EA1",
                    100: "#0B3D91",
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/forms"),
        require("@tailwindcss/aspect-ratio"),
        require("@tailwindcss/container-queries"),
    ],
};
