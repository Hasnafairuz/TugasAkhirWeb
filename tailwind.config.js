/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        cream: '#FAF8F5',
        softbeige: '#EFECE6',
        dustypink: '#D9A79A',
        sagegreen: '#9CAF88',
        darkbrown: '#3E2723',
      }
    },
  },
  plugins: [],
}