/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'media',
  content: [
    './app/Views/**/*.php', 
    './public/**/*.html',
    "./node_modules/flowbite/**/*.js",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin'),
    require('flowbite/plugin')({
      datatables: true,
    }),
    require('flowbite/plugin')({
      charts: true,
  }),
  ],
}