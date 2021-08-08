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
    color black
    margin 0
    padding 0
    font-family 'Montserrat', 'sans-serif'

body
    padding-top 88px

@media (max-width: 767px)
    body
        padding-top 0

*, *:before, *:after
    box-sizing border-box
    text-decoration none

a
    color black
</style>
