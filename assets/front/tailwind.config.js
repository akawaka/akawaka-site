const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: ["./public/**/*.html"],

    theme: {
        linearBorderGradients: {
            directions: {
                // defaults to these values
                t: "to top",
                tr: "to top right",
                r: "to right",
                br: "to bottom right",
                b: "to bottom",
                bl: "to bottom left",
                l: "to left",
                tl: "to top left",
            },
            colors: {
                // defaults to {}
                red: "#f00",
                "red-blue": ["#f00", "#00f"],
                "blue-green": ["#0000ff", "#00FF00"],
                "red-green-blue": ["#f00", "#0f0", "#00f"],
                "black-white-with-stops": ["#000", "#000 45%", "#fff 55%", "#fff"],
                "pink-orange": ["#de1e7e", "#f29e19"],
                "orange-pink": ["#f29e19", "#de1e7e"],
            },
            background: {
                "gray-50": "#F9FAFB",
                "gray-100": "#f3f4f6",
                "gray-700": "#1e1e1e",
                "gray-900": "#111827",
                white: "#fff",
                transparent: "#001e1e1e",
            },
            border: {
                // defaults to these values (optional)
                1: "1px",
                2: "2px",
                4: "4px",
            },
        },
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
                hind_guntur: ["Hind Guntur", ...defaultTheme.fontFamily.sans],
                expletus_sans: ["Expletus Sans", ...defaultTheme.fontFamily.sans],
                trirong: ["Trirong", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                yellow: {
                    500: "#f29e19",
                },
                pink: {
                    500: "#de1e7e",
                },
                blue: {
                    800: "#3a3076",
                },
                gray: {
                    700: "#1e1e1e",
                },
            },
            backgroundImage: {
                blacksheep: "url('images/logo-blacksheep.png')",
                wanimo: "url('images/logo-wanimo.png')",
                cfc: "url('images/logo-cfc.png')",
                toosports: "url('images/logo-toosports.png')",
                "brico-fenetre": "url('images/logo-brico-fenetre.png')",
                activinnov: "url('images/logo-activinnov.png')",
                psih: "url('images/logo-psih.png')",
                smsp: "url('images/logo-smsp.png')",
                wimova: "url('images/logo-wimova.png')",
                "gamma-software": "url('images/logo-gamma-software.jpg')",
                enoptea: "url('images/logo-enoptea.png')",
                "ensemble-losange-header": "url('images/fond_header.png')",
                "fond-noir": "url('images/fond_noir.png')",
                docker: "url('images/docker_logo.webp')",
                symfony: "url('images/symfony.webp')",
                git: "url('images/git.webp')",
                sylius: "url('images/sylius.webp')",
                rust: "url('images/rust.svg')",
                python: "url('images/python.webp')",
                github: "url('images/github-logo.svg')",
                php: "url('images/php-logo.svg')",
                "gitlab-ci-cd": "url('images/gitlab-ci-cd-logo.webp')",
                "vue-js": "url('images/vue-js-logo.svg')",
                react: "url('images/ract-logo.svg')",
                phpunit: "url('images/phpunit-logo.svg')",
                phpspec: "url('images/phpspec-logo.webp')",
                behat: "url('images/behat-logo.webp')",
                elastic: "url('images/elastic-logo.svg')",
                gpdis: "url('images/gpdis-logo.jpg')",
                afflelou: "url('images/logo-alain-afflelou.svg')",
                "credit-agricole": "url('images/logo_credit_agricole.svg')",
                convelio: "url('images/logo_convelio.png')",
                "dr-data": "url('images/logo-dr-data.png')",
                wava: "url('images/wava_logo.png')",
                djuringa: "url('images/logo-djuringa.png')"
            },
            backgroundSize: {
                "50%": "50%",
                52: "52rem",
                10: "10rem",
                13: "13rem",
                15: "15rem",
                18: "18rem",
                5: "5rem",
                8: "8rem",
            },

            backgroundPosition: {
                'top_left-10': '2.5rem 2.5rem',
                'bottom_right_10': '2.5rem 2.5rem',
            },

            spacing: {
                128: "32rem",
            },
            screens: {
                "3xl": "1275px",
                "4xl": "1450px",
                // => @media (min-width: 640px) { ... }
            },
            gridTemplateColumns: {
                technos: "repeat(auto-fit, minmax(8rem, 1fr))",
                "technos-md": "repeat(auto-fit, minmax(13rem, 1fr))",
                clients: "repeat(auto-fit, minmax(8rem, 1fr))",
                "clients-md": "repeat(auto-fit, minmax(20rem, 1fr))",
                equipe: "repeat(auto-fit, minmax(15rem, 1fr))",
                blog: "repeat(auto-fit, minmax(11rem, 1fr))",
                "blog-md": "repeat(auto-fit, minmax(16rem, 1fr))",
            },
        },
    },
    variants: {},
    plugins: [require("tailwindcss-border-gradient-radius")],
};
