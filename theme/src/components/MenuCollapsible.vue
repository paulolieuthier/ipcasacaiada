<template>
    <div id="content">
        <a href="#" :onclick="toggleMenu" class="strong">Menu <span id="arrow" :class="{ active: menuVisible }">&#11167;</span></a>
        <nav :class="{ hidden: !menuVisible }">
            <a href="#sobre-nos">Sobre Nós</a>
            <a href="#sermoes">Sermões</a>
            <a href="#ministerios">Ministérios</a>
            <a href="#contato">Contato</a>
        </nav>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            menuVisible: false,
        }
    },
    methods: {
        toggleMenu: function() {
            console.log('aeeee')
            this.menuVisible = !this.menuVisible
        }
    }
}
</script>

<style scoped lang="stylus">
#content
    padding 10px 0

    a
        color #444
        border-top 1px solid #eee
        font-size 14px
        line-height 14px
        padding 8px
        text-align center
        text-decoration none
        text-transform uppercase
        white-space nowrap
        width 100%

    a.strong
        font-weight 600

    span#arrow
        display inline-block
        transition transform 0.5s ease

    span#arrow.active
        transform rotate(180deg)

    nav
        display flex
        flex-flow column
        max-height 600px /* must be set but value doesn't matter */
        transition max-height 0.5s ease
        width 100%

    nav.hidden
        max-height 0
</style>
