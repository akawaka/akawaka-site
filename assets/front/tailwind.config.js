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
                blacksheep: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-blacksheep.png')",
                wanimo: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-wanimo.png')",
                cfc: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-cfc.png')",
                toosports: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-toosports.png')",
                "brico-fenetre": "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-brico-fenetre.png')",
                activinnov: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-activinnov.png')",
                psih: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-psih.png')",
                smsp: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-smsp.png')",
                wimova: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-wimova.png')",
                "gamma-software": "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-gamma-software.jpg')",
                enoptea: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-enoptea.png')",
                "ensemble-losange-header": "url('https://akawaka.github.io/akawaka-site/build/front/images/fond_header.png')",
                "fond-noir": "url('https://akawaka.github.io/akawaka-site/build/front/images/fond_noir.png')",
                docker: "url('https://akawaka.github.io/akawaka-site/build/front/images/docker_logo.webp')",
                symfony: "url('https://akawaka.github.io/akawaka-site/build/front/images/symfony.webp')",
                git: "url('https://akawaka.github.io/akawaka-site/build/front/images/git.webp')",
                sylius: "url('https://akawaka.github.io/akawaka-site/build/front/images/sylius.webp')",
                rust: "url('https://akawaka.github.io/akawaka-site/build/front/images/rust.svg')",
                python: "url('https://akawaka.github.io/akawaka-site/build/front/images/python.webp')",
                github: "url('https://akawaka.github.io/akawaka-site/build/front/images/github-logo.svg')",
                php: "url('https://akawaka.github.io/akawaka-site/build/front/images/php-logo.svg')",
                "gitlab-ci-cd": "url('https://akawaka.github.io/akawaka-site/build/front/images/gitlab-ci-cd-logo.webp')",
                "vue-js": "url('https://akawaka.github.io/akawaka-site/build/front/images/vue-js-logo.svg')",
                react: "url('https://akawaka.github.io/akawaka-site/build/front/images/ract-logo.svg')",
                phpunit: "url('https://akawaka.github.io/akawaka-site/build/front/images/phpunit-logo.svg')",
                phpspec: "url('https://akawaka.github.io/akawaka-site/build/front/images/phpspec-logo.webp')",
                behat: "url('https://akawaka.github.io/akawaka-site/build/front/images/behat-logo.webp')",
                elastic: "url('https://akawaka.github.io/akawaka-site/build/front/images/elastic-logo.svg')",
                gpdis: "url('https://akawaka.github.io/akawaka-site/build/front/images/gpdis-logo.jpg')",
                afflelou: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-alain-afflelou.svg')",
                "credit-agricole": "url('https://akawaka.github.io/akawaka-site/build/front/images/logo_credit_agricole.svg')",
                convelio: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo_convelio.png')",
                "dr-data": "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-dr-data.png')",
                wava: "url('https://akawaka.github.io/akawaka-site/build/front/images/wava_logo.png')",
                djuringa: "url('https://akawaka.github.io/akawaka-site/build/front/images/logo-djuringa.png')"
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
