/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./app/views/**/*.php",
      "./public/**/*.html",
    ],
    theme: {
      extend: {
        colors: {
          'oranye-1': '#F5EAE8',
          'oranye-2': '#EA7A55',
          'oranye-3': '#EDA25E',
          'oranye-4': '#FF914D',
          'hijau-1': '#7ED957',
          'merah-1': '#FF6262',
          'hijau-2': '#34AE00',
          'merah-2': '#F41717',
          'biru-3' : '#D7E3FF',
          'biru-4' : '#CDDBDC',
        },
        borderRadius: {
          'custom': '50px',
        },
      },
    },
    plugins: [],
  }
  
  