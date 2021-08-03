<template>
    <Section flow="row" class="light-gray">
        <div id="logo">
            <h1>Igreja Presbiteriana de Casa Caiada</h1>
            <div id="subtitle">Igreja Presbiteriana do Brasil</div>
        </div>
        <nav id="menu">
            <a class="selected" href="#">Início</a>
            <a href="#">Sobre Nós</a>
            <a href="#">Sermões</a>
            <a href="#">Ministérios</a>
            <a href="#">Contato</a>
        </nav>
    </Section>
</template>
  
<script>
import Section from './Section.vue'
  
export default {
    components: {
        Section,
    } 
} 
</script>
  
<style scoped lang="stylus">
Section
    background #fff
    border-bottom 1px solid #ccc
    border-top 8px solid #3069B3
    box-shadow 0 0 2px 0 #aaa
    flex-flow row nowrap
    height 90px
    position fixed
    top 0
    z-index 1000

    #logo
        align-items left
        background url(assets/logo.png) center left no-repeat
        background-size 60px 60px
        display flex
        flex-flow column nowrap
        height 100%
        justify-content center
        padding-left 80px

        h1
            font-size 22px
            line-height 30px
            margin 0
            padding 0

        #subtitle
            color #3069B3
            font-size 14px
            font-weight 600

    #menu
        display flex
        list-style none
        margin 0
        padding 0

        a
            color #444
            font-size 16px
            font-weight 600
            padding 8px
            position relative
            text-decoration none
            text-transform uppercase

    #menu a.selected,
    #menu:hover a:hover
        color #3069B3

    #menu a.selected:after,
    #menu:hover a:hover:after
        background #3069B3
        bottom 0px
        content ''
        height 4px
        display block
        left 8px
        position absolute
        right 8px

    #menu:hover a
        color #444

    #menu:hover a:after
        display none
</style>
