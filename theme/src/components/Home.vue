<template>
    <Section id="header" flow="row" class="light-gray">
        <div id="content">
            <header>
                <img :src="theme.logo" />
                <div id="title">
                    <h1>{{ site.title }}</h1>
                    <h2>{{ site.description }}</h2>
                </div>
            </header>
            <div id="menu-horizontal">
                <MenuHorizontal />
            </div>
            <div id="menu-collapsible">
                <MenuCollapsible />
            </div>
        </div>
    </Section>

    <Section id="banners" class="fill gray borderless">
        <div id="images">
            <template v-for="banner in theme.banners">
                <a :href="banner.page[0]?.uri" class="image" :style="`background-image: url('${banner.image}')`" />
            </template>
        </div>
    </Section>

    <Section id="intro" class="alternate spacing center">
        <div id="items">
            <div id="message">
                <span id="tagline">{{ theme.welcomeTitle }}</span>
                <span id="subscript">{{ theme.welcomeSubtitle }}</span>
            </div>
            <div id="video">
                <video controls :src="theme.welcomeVideo">
                    <source :src="theme.welcomeVideo" type="video/mp4" />
                </video>
            </div>
        </div>
    </Section>

    <Section id="about-us" class="spacing" flow="column" title="Sobre Nós">
        <ul>
            <template v-for="(section, index) in theme.aboutUs">
                <li :class="{ alternate: index % 2, border: index < theme.aboutUs.length - 1 }">
                    <div class="card">
                        <img :src="section.image" />
                    </div>
                    <div class="content">
                        <h1>{{ section.title }}</h1>
                        <div v-html="section.content" />
                        <div class="buttons">
                            <template v-for="action in section.actions">
                                <Button :link="action.page[0]?.uri">{{ action.text }}</Button>
                            </template>
                        </div>
                    </div>
                </li>
            </template>
        </ul>
    </Section>

    <Section id="sermon-series" class="spacing alternate" flow="column" title="Séries de Sermões">
        <div id="cards">
            <a v-for="sermon in sermons" id="card" href="#">
                <div class="image-wrapper">
                    <img :src="asset(sermon.image)" />
                </div>
                <template v-if="sermon.title">
                    <span>{{ sermon.title }}</span>
                </template>
            </a>
        </div>
        <Button class="see-more">Ver Todos</Button>
    </Section>

    <Section id="groups" class="fill spacing-top" flow="column" title="Ministérios">
        <div id="cards">
            <template v-for="group in theme.groups">
                <a :href="group.page[0]?.uri" class="card">
                    <img :src="group.image">
                    <span>{{group.name}}</span>
                </a>
            </template>
        </div>
    </Section>

    <Section id="contact" class="spacing alternate" flow="column" title="Entre em Contato">
        <div id="contact-row">
            <div id="contact-info">
                <a :href="whatsappLink" target="_blank">
                    <i class="fab icon-large fa-whatsapp"></i>
                    <p>
                        <span class="title">Whatsapp</span>
                        <span class="subtitle">{{ theme.contactWhatsapp }}</span>
                    </p>
                </a>
                <a :href="phoneLink" target="_blank">
                    <i class="fas icon-large fa-mobile-alt"></i>
                    <p>
                        <span class="title">Telefone</span>
                        <span class="subtitle">{{ theme.contactPhone }}</span>
                    </p>
                </a>
                <a :href="locationLink" target="_blank">
                    <i class="fas icon-medium fa-map-marked-alt"></i>
                    <p>
                        <span class="title">Localização</span>
                        <span class="subtitle">{{ theme.contactLocation }}</span>
                    </p>
                </a>
                <a :href="emailLink" target="_blank">
                    <i class="fas icon-medium fa-envelope-open-text"></i>
                    <p>
                        <span class="title">Email</span>
                        <span class="subtitle">{{ theme.contactEmail }}</span>
                    </p>
                </a>
            </div>
            <div id="contact-form">
                <input type="text" placeholder="Nome" />
                <input type="text" placeholder="Email" />
                <input type="text" placeholder="Telefone" />
                <textarea type="text" placeholder="Mensagem" rows="3"></textarea>
                <input type="submit" value="Enviar" />
            </div>
        </div>
    </Section>

    <Section id="footer" class="dark">
        <div id="footer-items">
            <div id="footer-main-item">
                <h3>{{ theme.footerFirstTitle }}</h3>
                {{ theme.footerFirst }}
            </div>
            <div id="footer-secondary-items">
                <div id="item">
                    <h3>{{ theme.footerSecondTitle }}</h3>
                    {{ theme.footerSecond }}
                </div>
                <div id="item">
                    <h3>Redes Sociais</h3>
                    <a v-if="theme.socialYoutube" :href="theme.socialYoutube"><i class="fab fa-youtube"></i></a>
                    <a v-if="theme.socialInstagram" :href="theme.socialInstagram"><i class="fab fa-instagram"></i></a>
                    <a v-if="theme.socialFacebook" :href="theme.socialFacebook"><i class="fab fa-facebook"></i></a>
                    <a v-if="theme.socialSpotify" :href="theme.socialSpotify"><i class="fab fa-spotify"></i></a>
                </div>
            </div>
        </div>
    </Section>

    <Section id="copyright" class="darker center">
        {{ site.title }}
    </Section>
</template>

<script>
import MenuHorizontal from './MenuHorizontal.vue'
import MenuCollapsible from './MenuCollapsible.vue'
import Section from './Section.vue'
import Button from './Button.vue'

import gql from 'graphql-tag'

export default {
    components: {
        Section,
        Button,
        MenuHorizontal,
        MenuCollapsible,
    },
    apollo: {
        query: {
            query: gql`query {
                site: generalSettings {
                    title
                    description
                }
                theme: crbThemeOptions {
                    logo
                    welcomeTitle
                    welcomeSubtitle
                    welcomeVideo
                    banners {
                        image
                        page {
                            uri
                        }
                    }
                    aboutUs {
                        title
                        content
                        image
                        actions {
                            text
                            page {
                                uri
                            }
                        }
                    }
                    groups {
                        name
                        image
                        page {
                            uri
                        }
                    }
                    contactWhatsapp,
                    contactPhone,
                    contactLocation,
                    contactEmail,
                    footerFirstTitle,
                    footerFirst,
                    footerSecondTitle,
                    footerSecond,
                    socialYoutube,
                    socialInstagram,
                    socialFacebook,
                    socialSpotify,
                }
            }`,
            manual: true,
            result: function({ data, loading }) {
                if (!loading) {
                    this.site = data.site
                    this.theme = data.theme
                }
            },
        }
    },
    data: function() {
        return {
            // default initialization of root queried data is necessary
            site: {},
            theme: {},
            sermons: [
                { title: 'Atos', image: 'sermons/series-1.jpg' },
                { title: '1 Coríntios', image: 'sermons/series-2.jpg' },
                { title: '2 Coríntios', image: 'sermons/series-3.jpg' },
                { title: 'Eclesiastes', image: 'sermons/series-4.jpg' },
                { title: 'Apocalipse', image: 'sermons/series-5.jpg' },
                { title: 'Sermão Profético', image: 'sermons/series-6.jpg' },
                { title: 'Romanos', image: 'sermons/series-7.jpg' },
                { title: 'Salmos', image: 'sermons/series-8.jpg' },
            ]
        }
    },
    computed: {
        whatsappLink: function() {
            if (this.theme.contactWhatsapp) {
                const whatsapp = this.theme.contactWhatsapp.replaceAll(/[^0-9]+/g, '')
                return 'https://api.whatsapp.com/send?phone=+55' + whatsapp
            }
        },
        phoneLink: function() {
            if (this.theme.contactPhone) {
                const phone = this.theme.contactPhone.replaceAll(/[^0-9]+/g, '')
                return 'tel:+55' + phone
            }
        },
        locationLink: function() {
            if (this.theme.contactLocation) {
                const location = this.theme.contactLocation.replaceAll(/\s+/g, ' ')
                return 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(location)
            }
        },
        emailLink: function() {
            if (this.theme.contactEmail) {
                const email = this.theme.contactEmail.trim()
                return 'mailto:' + email
            }
        }
    }
}
</script>

<style scoped lang="stylus">
.see-more
    margin-top 30px !important

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
                    /* font-size calc(13px + (25 - 13) * ((100vw - 360px) / (1920 - 360))) */
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
        position initial

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

Section#banners
    #images
        display grid
        height 40vh
        width 100%

        .image
            background-position center center
            background-repeat no-repeat
            background-size cover
            grid-column 1
            grid-row 1
            height 100%
            width 100%

Section#intro
    #items
        align-items center
        display grid
        grid-gap 40px
        grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 400px)}, 1fr))
        justify-items center
        padding 0 40px
        width 100%

    #message
        display flex
        flex-flow column nowrap
        font-family 'Montserrat'
        text-align left

        #tagline
            font-size @css{min(26px, max(22px, 2vw))}
            font-weight 800

        #subscript
            color #444
            font-size 16px
            font-weight 400
            margin-top 20px

    #video
        max-width 500px
        text-align center

        video
            width 100%

Section#about-us ul
    display flex
    flex-flow column wrap
    justify-content space-between
    list-style none
    margin 0
    padding 0
    width 100%

    li
        display flex
        flex-flow row nowrap
        margin-top 30px
        width 100%

        .card
            border-radius 3px 0 0 3px
            display flex
            mask-image linear-gradient(to right, rgb(0, 0, 0) 75%, transparent)
            min-width 30%

            img
                min-height 100%
                min-width 100%
                object-fit cover
                object-position center

        .content
            padding 10px 20px 10px 40px

            h1
                margin: 0

            div
                line-height 25px
                padding 10px 0

            .buttons
                display inline-flex
                flex-flow row wrap
                gap 20px

    li.alternate
        flex-direction row-reverse

        .card
            border-radius 0 3px 3px 0
            mask-image linear-gradient(to left, rgb(0, 0, 0) 75%, transparent)

        .content
            padding 10px 40px 10px 20px

    li.border
        border-bottom 1px solid #ccc
        padding-bottom 40px

    @media (max-width: 800px)
        li, li.alternate
            flex-flow column nowrap

            .card
                border-radius 0
                height 200px
                margin-bottom 30px
                mask-image linear-gradient(to bottom, transparent, rgb(0, 0, 0) 1%, rgb(0, 0, 0) 75%, transparent)

        li.border
            border-bottom none
            margin-bottom 30px
            padding-bottom 0

Section#sermon-series
    #cards
        display grid
        grid-gap 50px
        grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 180px)}, 1fr))
        justify-items center
        padding 20px 50px
        width 100%

        #card
            align-items center
            display flex
            flex-flow column nowrap
            max-width 300px
            width 100%

        #card .image-wrapper
            box-shadow 0 0 1px #000
            overflow hidden
            width 100%

        #card img
            display block
            transition transform 0.2s
            width 100%

        #card span
            font-weight 600
            margin 10px 0
            padding 10px 0
            position relative

        #card:hover img
            transform scale(1.1)

        #card:hover span::after
            background #3069B3
            bottom 2px
            content ''
            height 4px
            left 0
            position absolute
            width 100%

Section#groups
    #cards
        display grid
        grid-auto-flow row dense
        grid-template-columns repeat(auto-fit, minmax(@css{min(80%, 240px)}, 1fr));
        max-width 1920px
        width 100%

        .card
            background black
            position relative

            img
                opacity 0.7
                width 100%

            span
                color white
                background rgba(0, 0, 0, 0.5)
                bottom 0
                left 0
                padding 15px
                position absolute
                font-weight bold
                width 100%

        .card:hover
            img
                opacity 1

Section#contact #contact-row
    align-items start
    display grid
    grid-row-gap 80px
    grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 400px)}, 1fr))
    justify-items center
    padding 30px 50px
    width 100%

    #contact-form
        min-width 70%

    #contact-info
        display flex
        flex-flow column nowrap
        gap 40px

        a
            align-items center
            display grid
            grid-column-gap 30px
            grid-template-columns 60px auto
            width 100%

            i
                text-align center

            i.icon-medium
                font-size 2.8rem

            i.icon-large
                font-size 3.5rem

            p
                display flex
                flex-flow column nowrap
                margin 0

                span.title
                    font-size 18px

                span.subtitle
                    color #444
                    font-size 16px
                    margin-top 5px
                    white-space pre

        a:hover, a:hover span.subtitle
            color #3069B3

    #contact-form
        background white
        border-radius 5px
        box-shadow 0 0 2px #aaa
        display flex
        flex-flow column nowrap
        padding 25px

        input, textarea
            border 1px solid #ddd
            border-radius 1px
            font-size 14px
            margin 5px 0
            padding 15px

        input[type="submit"]
            background transparent
            border-radius 0 !important
            border 2px solid #3069B3!important
            color #3069B3
            font-weight 600
            padding 15px !important
            text-decoration none

        input[type="submit"]:hover
            color white
            cursor pointer
            background #3069B3

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
    text-align center
</style>
