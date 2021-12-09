<template>
    <template v-if="!loading">
        <Section id="header" flow="row" class="light-gray">
            <div id="content">
                <header>
                    <router-link to="/">
                        <img :src="data.logo" />
                    </router-link>
                    <div id="title">
                        <router-link to="/">
                            <h1>{{ data.title }}</h1>
                        </router-link>
                        <h2>{{ data.subtitle }}</h2>
                    </div>
                </header>
                <div id="menu-horizontal">
                    <MenuHorizontal ref="menu" />
                </div>
                <div id="menu-collapsible">
                    <MenuCollapsible />
                </div>
            </div>
        </Section>

        <router-view v-on:pageLoaded="onPageLoaded" v-on:scrolledToSection="onScrolledToSection" />

        <Section id="footer" class="dark">
            <div id="footer-items">
                <div id="footer-main-item">
                    <h3>{{ data.footer.first.title }}</h3>
                    {{ data.footer.first.content }}
                </div>
                <div id="footer-secondary-items">
                    <div id="item">
                        <h3>{{ data.footer.second.title }}</h3>
                        {{ data.footer.second.content }}
                    </div>
                    <div id="item">
                        <h3>Redes Sociais</h3>
                        <a v-if="data.footer.social.youtube" :href="data.footer.social.youtube">
                            <i class="fab fa-youtube" />
                        </a>
                        <a v-if="data.footer.social.instagram" :href="data.footer.social.instagram">
                            <i class="fab fa-instagram" />
                        </a>
                        <a v-if="data.footer.social.facebook" :href="data.footer.social.facebook">
                            <i class="fab fa-facebook" />
                        </a>
                        <a v-if="data.footer.social.spotify" :href="data.footer.social.spotify">
                            <i class="fab fa-spotify" />
                        </a>
                    </div>
                </div>
            </div>
        </Section>

        <Section id="copyright" class="darker center">
            <span>{{ data.title }}</span>
        </Section>
    </template>
</template>

<script>
import Section from './Section.vue'
import MenuHorizontal from './MenuHorizontal.vue'
import MenuCollapsible from './MenuCollapsible.vue'

import { ref } from 'vue'
import Bus from '../bus.js'
import Querier from '../querier.js'

export default {
    components: {
        Section,
        MenuHorizontal,
        MenuCollapsible,
    },
    setup() {
        const { loading, data } = Querier.home()
        return {
            bus: new Bus(),
            menu: ref(null),
            loading,
            data,
        }
    },
    methods: {
        once(event, f) {
            this.bus.once(event, f)
        },
        onPageLoaded() {
            this.bus.emit('pageLoaded')
        },
        onScrolledToSection(section) {
            this.menu.activate(section)
        }
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
    font-size 14px

*, *:before, *:after
    box-sizing border-box
    text-decoration none

a
    color black
</style>

<style scoped lang="stylus">
Section#header
    border-bottom 1px solid #ccc
    border-top 5px solid #3069B3 !important
    box-shadow 0 0 2px 0 #aaa
    height 90px
    position sticky
    top 0
    z-index 1000

    #content
        align-items center
        display flex
        flex-flow row nowrap
        height 100%
        justify-content space-between
        padding 0 10px
        width 100%

        header
            display grid
            grid-template-columns  55px 1fr
            grid-template-rows  55px

            img
                height 100%

            #title
                display flex
                flex-flow column nowrap
                height 100%
                justify-content center
                padding-left 20px

                h1
                    font-size @css{min(26px, max(16px, 2vw))}
                    margin 0
                    padding 0

                    span
                        white-space nowrap

                h2
                    color #3069B3
                    font-size @css{min(14px, max(12px, 1.4vw))}
                    font-weight 600
                    margin 0
                    padding 0
                    white-space nowrap

    #menu-collapsible
        display none
        width 100%

@media (max-width: 767px)
    Section#header
        height auto

        #menu-horizontal
            display none

        #menu-collapsible
            display block

        #content
            flex-flow column nowrap

            header
                padding 10px 0

                #title h1 span
                    white-space normal

Section#footer
    color #eee
    font-size 14px
    padding 40px 15px 40px

    #footer-items
        display grid
        grid-gap 40px
        grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 300px)}, 1fr))

        #footer-main-item, #footer-secondary-items
            padding 0 20px
            white-space pre-line

        #footer-secondary-items
            display grid
            grid-gap 40px
            grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 200px)}, 1fr))

            #item
                font-weight 300
                white-space pre-line

        h3
            font-size 16px
            margin 0 0 10px

        a
            color white

        i
            font-size 22px
            padding 5px 20px 0 0

        i:hover
            transform scale(1.1)

Section#copyright
    color #eee
    font-size 15px
    font-weight 300
    padding 20px 0

    span
        text-align center
        width 100%
</style>
