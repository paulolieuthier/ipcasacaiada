<template>
    <div id="content">
        <a id="menu" :onclick="toggleMenu" :class="{ active: menuVisible }">
            Menu <i id="arrow" class="fas fa-angle-double-down"></i>
        </a>
        <nav :class="{ hidden: !menuVisible }">
            <a :onclick="toggleMenu" href="/#sobre-nos">Sobre Nós</a>
            <a :onclick="toggleMenu" href="/#sermoes">Sermões</a>
            <a :onclick="toggleMenu" href="/#ministerios">Ministérios</a>
            <a :onclick="toggleMenu" href="/#contato">Contato</a>
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

    a#menu
        cursor pointer
        display flex
        font-weight 600
        gap 3px
        justify-content center

    i#arrow
        display inline-block
        transition transform 0.5s ease

    a#menu.active i#arrow
        transform rotate(180deg)

    nav
        display flex
        flex-flow column
        max-height 600px /* must be set but value doesn't matter */
        transition max-height 0.5s ease
        width 100%

    nav.hidden
        display none
        max-height 0
</style>
