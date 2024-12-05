/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./application/views/**/*.php", "./public/**/*.html"],
  theme: {
    extend: {},
    colors: {
      coral: {
        500: "#E76F51",
        600: "#d66347",
      },
    },
    plugins: [],
  },
};
