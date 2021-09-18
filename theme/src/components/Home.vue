<template>
    <template v-if="!loading">
        <a class="anchor" id="inicio" ref="inicio" />
        <Section id="banners" class="fill gray borderless">
            <Carousel>
                <template v-for="banner in data.banners" :key="banner.image">
                    <a class="banner" :href="banner.uri" :style="`background-image: url('${banner.image}')`" />
                </template>
            </Carousel>
        </Section>

        <Section id="intro" class="alternate spacing center">
            <div id="items">
                <div id="message">
                    <span id="tagline">{{ data.welcome.title }}</span>
                    <span id="subscript">{{ data.welcome.subtitle }}</span>
                </div>
                <div id="video">
                    <video controls :src="data.welcome.video">
                        <source :src="data.welcome.video" type="video/mp4" />
                    </video>
                </div>
            </div>
        </Section>

        <a class="anchor" id="sobre-nos" ref="sobre-nos" />
        <Section id="about-us" class="spacing" flow="column" title="Sobre Nós">
            <ul>
                <template v-for="(section, index) in data.aboutUs" :key="section.title">
                    <li :class="{ alternate: index % 2, border: index < data.aboutUs.length - 1 }">
                        <div class="card" :style="`background-image: url('${section.image}')`" />
                        <div class="content">
                            <h1>{{ section.title }}</h1>
                            <div v-html="section.content" />
                            <div class="buttons">
                                <template v-for="button in section.buttons" :key="button.uri">
                                    <Button :link="button.uri">{{ button.text }}</Button>
                                </template>
                            </div>
                        </div>
                    </li>
                </template>
            </ul>
        </Section>

        <a class="anchor" id="sermoes" ref="sermoes" />
        <Section id="sermon-series" class="spacing alternate" flow="column" title="Séries de Sermões">
            <div id="cards">
                <template v-for="series in data.sermons" :key="series.slug">
                    <a id="card" :href="`/sermon-series/${series.slug}`">
                        <div class="image-wrapper">
                            <img :src="series.image" />
                        </div>
                        <span>{{ series.name }}</span>
                    </a>
                </template>
            </div>
            <Button class="see-more">Ver Todos</Button>
        </Section>

        <a class="anchor" id="ministerios" ref="ministerios" />
        <Section id="groups" class="fill spacing-top" flow="column" title="Ministérios">
            <div id="cards">
                <template v-for="group in data.groups" :key="group.slug">
                    <a :href="`/ministerios/${group.slug}`" class="card">
                        <img :src="group.image" />
                        <span>{{group.name}}</span>
                    </a>
                </template>
            </div>
        </Section>

        <a class="anchor" id="contato" ref="contato" />
        <Section id="contact" class="spacing alternate" flow="column" title="Entre em Contato">
            <div id="contact-row">
                <div id="contact-info">
                    <a :href="whatsappLink" target="_blank">
                        <i class="fab icon-large fa-whatsapp"></i>
                        <p>
                            <span class="title">Whatsapp</span>
                            <span class="subtitle">{{ data.contact.whatsapp }}</span>
                        </p>
                    </a>
                    <a :href="phoneLink" target="_blank">
                        <i class="fas icon-large fa-mobile-alt"></i>
                        <p>
                            <span class="title">Telefone</span>
                            <span class="subtitle">{{ data.contact.phone }}</span>
                        </p>
                    </a>
                    <a :href="locationLink" target="_blank">
                        <i class="fas icon-medium fa-map-marked-alt"></i>
                        <p>
                            <span class="title">Localização</span>
                            <span class="subtitle">{{ data.contact.location }}</span>
                        </p>
                    </a>
                    <a :href="emailLink" target="_blank">
                        <i class="fas icon-medium fa-envelope-open-text"></i>
                        <p>
                            <span class="title">Email</span>
                            <span class="subtitle">{{ data.contact.email }}</span>
                        </p>
                    </a>
                </div>
                <form id="contact-form" ref="contact">
                    <input type="text" id="contact-name" placeholder="Nome" />
                    <textarea type="text" id="contact-message" placeholder="Mensagem" rows="6"></textarea>
                    <input type="submit" value="Enviar pelo Whatsapp" />
                </form>
            </div>
        </Section>
    </template>
</template>

<script>
import Section from './Section.vue'
import Carousel from './Carousel.vue'
import Button from './Button.vue'

import { ref } from 'vue'
import Querier from '../querier.js'

export default {
    components: {
        Section,
        Carousel,
        Button,
    },
    emits: ['scrolledToSection'],
    setup() {
        const { loading, data } = Querier.home()

        return {
            // anchors
            inicio: ref(null),
            'sobre-nos': ref(null),
            sermoes: ref(null),
            ministerios: ref(null),
            contato: ref(null),

            contact: ref(null),

            loading,
            data
        }
    },
    mounted() {
                this.$nextTick(() => {
                    // trigger scroll to correct section
                    // can't make it work without a timer
                    setTimeout(() => this.$refs[window.location.hash.slice(1)]?.scrollIntoView(), 400)

                    this.contact.addEventListener('submit', this.onContact)
                    window.addEventListener('scroll', this.onScroll)
                })
    },
    computed: {
        anchors() {
            return {
                inicio: this.$refs.inicio,
                'sobre-nos': this.$refs['sobre-nos'],
                sermoes: this.$refs.sermoes,
                ministerios: this.$refs.ministerios,
                contato: this.$refs.contato,
            }
        },
        whatsappNumber() {
            if (this.data.contact.whatsapp) {
                return this.data.contact.whatsapp.replaceAll(/[^0-9]+/g, '')
            }
        },
        whatsappLink() {
            return this.buildWhatsappLink()
        },
        phoneLink() {
            if (this.data.contact.phone) {
                const phone = this.data.contact.phone.replaceAll(/[^0-9]+/g, '')
                return 'tel:+55' + phone
            }
        },
        locationLink() {
            if (this.data.contact.location) {
                const location = this.data.contact.location.replaceAll(/\s+/g, ' ')
                return 'https://www.google.com/maps/search/?api=1&query=' + encodeURI(location)
            }
        },
        emailLink() {
            if (this.data.contact.email) {
                const email = this.data.contact.email.trim()
                return 'mailto:' + email
            }
        }
    },
    methods: {
        buildWhatsappLink(message) {
            if (this.whatsappNumber) {
                let link = 'https://api.whatsapp.com/send?lang=pt_br&phone=+55' + this.whatsappNumber
                if (message) {
                    link += '&text=' + encodeURI(message)
                }
                return link
            }
        },
        onScroll() {
            let item = null;
            for (let anchor in this.anchors) {
                const rect = this.anchors[anchor].getBoundingClientRect()
                if (rect.top < (window.innerHeight || document.documentElement.clientHeight) / 2) {
                    item = anchor
                }
            }
            this.$emit('scrolledToSection', item)
        },
        onContact(event) {
            event.preventDefault()
            const name = this.contact.querySelector('input#contact-name').value
            const message = this.contact.querySelector('textarea#contact-message').value
            const link = this.buildWhatsappLink(`Olá, sou ${name}. ${message}`)
            window.open(link, '_blank').focus()
        }
    }
}
</script>

<style scoped lang="stylus">
.see-more
    margin-top 30px !important

a.anchor
    position relative
    top -50px

a.anchor#inicio
    top -200px

Section#banners
    height 300px

    .banner
        background-position center center
        background-size cover

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
        aspect-ratio 16/9
        max-width 500px
        text-align center
        width 100%

        video
            height 100%
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
            background-position center
            background-repeat no-repeat
            background-size cover
            border-radius 3px 0 0 3px
            display flex
            mask-image linear-gradient(to right, rgb(0, 0, 0) 75%, transparent)
            min-width 30%

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
</style>
