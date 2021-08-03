<template>
    <Header />
    <Home />
</template>
  
<script>
import Header from './Header.vue'
import Home from './Home.vue'
  
export default {
    components: {
        Header,
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


*, *:before, *:after
    box-sizing border-box
    text-decoration none

a
    color black
</style>
