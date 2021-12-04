<template>
    <nav>
        <span ref="inicio">
            <router-link to="/#inicio">Início</router-link>
        </span>
        <span ref="sobre-nos">
            <router-link to="/#sobre-nos">Sobre Nós</router-link>
        </span>
        <span ref="sermoes">
            <router-link to="/#sermoes">Sermões</router-link>
        </span>
        <span ref="ministerios">
            <router-link to="/#ministerios">Ministérios</router-link>
        </span>
        <span ref="contato">
            <router-link to="/#contato">Contato</router-link>
        </span>
    </nav>
</template>

<script>
export default {
    methods: {
        activate(item) {
            // if null, clear active mark
            if (!item) {
                this.$el.querySelector('.selected')?.classList.remove('selected')
                return
            }

            const next = this.$refs[item]
            if (next) {
                const selected = this.$el.querySelector('.selected')
                if (selected !== next) {
                    selected?.classList.remove('selected')
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

nav span.selected a,
nav:hover span:hover a
    color #3069B3

nav span.selected a:after,
nav:hover span:hover a:after
    background #3069B3
    bottom 0px
    content ''
    height 4px
    display block
    left 8px
    position absolute
    right 8px

nav:hover span a
    color #444

nav:hover span a:after
    display none
</style>
