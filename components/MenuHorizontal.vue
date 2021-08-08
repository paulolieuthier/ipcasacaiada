<template>
    <nav>
        <a class="selected" href="#">Início</a>
        <a href="#">Sobre Nós</a>
        <a href="#">Sermões</a>
        <a href="#">Ministérios</a>
        <a href="#">Contato</a>
    </nav>
</template>

<style scoped lang="stylus">
nav
    display flex
    margin 0
    padding 0
    white-space nowrap

    a
        color #444
        font-size @css{min(16px, max(14px, 1.5vw))}
        font-weight 600
        padding 8px
        position relative
        text-decoration none
        text-transform uppercase

nav a.selected,
nav:hover a:hover
    color #3069B3

nav a.selected:after,
nav:hover a:hover:after
    background #3069B3
    bottom 0px
    content ''
    height 4px
    display block
    left 8px
    position absolute
    right 8px

nav:hover a
    color #444

nav:hover a:after
    display none
</style>
