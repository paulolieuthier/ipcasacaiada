<template>
    <Home />
</template>
  
<script>
import Home from './Home.vue'
  
export default {
    components: {
        Home
    } 
} 
</script>
  
<style lang="stylus">
html, body
    margin 0
    padding 0
    scroll-behavior smooth

body
    color black
    font-family 'Montserrat', 'sans-serif'

*, *:before, *:after
    box-sizing border-box
    text-decoration none

a
    color black
</style>
