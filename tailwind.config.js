module.exports = {
    content: [

        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            animation: {
                'fade-in': 'fadein 0.2s linear forwards',
                'fade-out': 'fadeout 0.2s linear forwards',
            },

            keyframes: {
                fadein: {
                    '0%': {
                        opacity: '0'
                    },
                    '100%': {
                        opacity: '1'
                    },
                },

                fadeout: {
                    '0%': {
                        opacity: '1'
                    },
                    '100%': {
                        opacity: '0'
                    },
                }
            }
        },
    },
    plugins: [],
}
