<template>
    <nav>
        <a ref="inicio" class="selected" href="/#inicio">Início</a>
        <a ref="sobre-nos" href="/#sobre-nos">Sobre Nós</a>
        <a ref="sermoes" href="/#sermoes">Sermões</a>
        <a ref="ministerios" href="/#ministerios">Ministérios</a>
        <a ref="contato" href="/#contato">Contato</a>
    </nav>
</template>

<script>
export default {
    methods: {
        activate(item) {
            const next = this.$refs[item]
            if (next) {
                const selected = this.$el.querySelector('.selected')
                if (selected !== next) {
                    selected.classList.remove('selected')
                    next.classList.add('selected')
                }
            }
        }
    }
}
</script>

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
