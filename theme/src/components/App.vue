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

*, *:before, *:after
    box-sizing border-box
    text-decoration none

a
    color black

body #app
    padding-top 88px

    @media (max-width: 767px)
        padding-top 0

body.admin-bar #app
    padding-top calc(88px + 46px)

    @media screen and (min-width:782px)
        padding-top calc(88px + 32px)
</style>
