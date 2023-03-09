/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*/*/*/*.php"],
  theme: {
    screens: {
      'xs': '480px',
      'sm': '576px',
      'md': '768px',
      'lg': '992px',
      'xl': '1200px',
      '2xl': '1400px'
    },
    extend: {
      objectPosition: {
        'top-center': '100% 25%'
      }
    },
  },
  plugins: [],
}
