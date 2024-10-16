/** @type {import('tailwindcss').Config} */

module.exports = {
    content: [
        "./index.php",
        "./component.php",
        "./error.php",
        //"./offline.php"
        "./html/**/*.{html,php}"
    ],
    theme: {
        extend: {

        },
    },
    plugins: [
        //require('@tailwindcss/typography'),
    ],
}
