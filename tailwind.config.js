/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",    
  ],
  theme: {
    extend: {
      backgroundImage: {
        'home-banner': "url('images/home/hero-bg.png')",        
      },
    },
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      'black': '#040404',
      'white': '#ffffff',
      'gray1': '#c1c1c1',
      'gray2': '#7a7a7a',
      'first': '#ffb43a',      
    },
  },
  plugins: [],
}