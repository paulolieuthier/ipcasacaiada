<template>
    <Header />

    <Section id="banners" class="fill gray">
        <div id="images">
            <img id="banner-1" src="assets/banners/banner-3.jpg">
            <img id="banner-2" src="assets/banners/banner-2.jpg">
            <img id="banner-3" src="assets/banners/banner-3.jpg">
        </div>
    </section>

    <Section id="intro" class="alternate spacing center">
        <div id="items">
            <div id="message">
                <span id="tagline">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                <span id="subscript">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
            </div>
            <div id="video">
                <video controls>
                    <source src="assets/placeholder-intro.mp4" type="video/mp4" />
                </video>
            </div>
        </div>
    </Section>

    <Section id="about-us" class="spacing" flow="column" title="Sobre Nós">
        <ul>
            <template v-for="(section, index) in about">
                <li :class="{ alternate: index % 2, border: index < about.length - 1 }">
                    <div class="card">
                        <img :src="section.image" />
                    </div>
                    <div class="content">
                        <h1>{{ section.title }}</h1>
                        <p>{{ section.content }}</p>
                        <div class="buttons">
                            <template v-for="action in section.actions">
                                <Button>{{ action.text }}</Button>
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
                <div class="card">
                    <div class="image-wrapper">
                        <img :src="sermon.image" />
                    </div>
                    <template v-if="sermon.title">
                        <span>{{ sermon.title }}</span>
                    </template>
                </div>
            </a>
        </div>
        <Button class="see-more">Ver Todos</Button>
    </Section>

    <Section id="groups" class="fill spacing-top" flow="column" title="Ministérios">
        <div id="cards">
            <a href="#" class="card">
                <img src="assets/groups/square-1.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-2.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-3.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-4.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-5.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-1.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-2.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-3.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-4.jpg">
                <span>Ministério</span>
            </a>
            <a href="#" class="card">
                <img src="assets/groups/square-5.jpg">
                <span>Ministério</span>
            </a>
        </div>
    </Section>

    <Section id="contact" class="spacing alternate" flow="column" title="Entre em Contato">
        <div id="contact-row">
            <div id="contact-info">
                <i class="fab icon-large fa-whatsapp"></i>
                <p>
                    <span class="title">Whatsapp</span>
                    <span class="subtitle">(81) 9319-6221</span>
                </p>
                <i class="fas icon-large fa-mobile-alt"></i>
                <p>
                    <span class="title">Telefone</span>
                    <span class="subtitle">(81) 3432-3629</span>
                </p>
                <i class="fas icon-medium fa-map-marked-alt"></i>
                <p>
                    <span class="title">Localização</span>
                    <span class="subtitle">Rua Alcina Coelho de Carvalho, 700<br />Casa Caiada, Olinda - PE</span>
                </p>
                <i class="fas icon-medium fa-envelope-open-text"></i>
                <p>
                    <span class="title">Email</span>
                    <span class="subtitle">central.ipcc@gmail.com</span>
                </p>
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
                <h3>A IPCC</h3>
                Somos uma igreja cristã, reformada e federada à Igreja Presbiteriana do Brasil, através do Presbitério Olinda Norte. Nossa denominação está no Brasil há mais de 150 anos e tem uma história que remonta à Reforma Protestante (1517 A.D.). Se você deseja conhecer melhor a IPB, pode acessar ipb.org.br.
            </div>
            <div id="footer-secondary-items">
                <div id="item">
                    <h3>Horários – Domingo</h3>
                    09:00 – Culto Matutino
                    <br />
                    10:00 – Escola Dominical
                    <br />
                    18:30 – Culto Noturno
                </div>
                <div id="item">
                    <h3>Redes Sociais</h3>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-facebook"></i>
                    <i class="fab fa-spotify"></i>
                </div>
            </div>
        </div>
    </Section>

    <Section id="copyright" class="darker center">
        Igreja Presbiteriana de Casa Caiada
    </Section>
</template>

<script>
import Section from './Section.vue'
import Button from './Button.vue'

export default {
    components: {
        Section,
        Button,
    },
    data: function () {
        return {
            about: [
                {
                    'title': 'No Que Cremos',
                    'image': 'assets/about/about-1.jpg',
                    'content': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'actions': [
                        { 'text': 'Documentos de fé' }
                    ]
                },
                {
                    'title': 'Onde Estamos?',
                    'image': 'assets/about/about-2.jpg',
                    'content': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'actions': [
                        { 'text': 'Ver mapa' }
                    ]
                },
                {
                    'title': 'A IPCC',
                    'image': 'assets/about/about-3.jpg',
                    'content': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'actions': [
                        { 'text': 'Nossa história' },
                        { 'text': 'Nossos oficiais' }
                    ]
                },
                {
                    'title': 'Envolva-se',
                    'image': 'assets/about/about-4.jpg',
                    'content': 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'actions': [
                        { 'text': 'Ver mais' }
                    ]
                }
            ],
            sermons: [
                { title: 'Atos', image: 'assets/sermons/series-1.jpg' },
                { title: '1 Coríntios', image: 'assets/sermons/series-2.jpg' },
                { title: '2 Coríntios', image: 'assets/sermons/series-3.jpg' },
                { title: 'Eclesiastes', image: 'assets/sermons/series-4.jpg' },
                { title: 'Apocalipse', image: 'assets/sermons/series-5.jpg' },
                { title: 'Sermão Profético', image: 'assets/sermons/series-6.jpg' },
                { title: 'Romanos', image: 'assets/sermons/series-7.jpg' },
                { title: 'Salmos', image: 'assets/sermons/series-8.jpg' },
            ]
        }
    }
}
</script>

<style scoped lang="stylus">
.see-more
    margin-top 30px !important

Section#banners
    #images
        display grid

        img
            grid-column 1
            grid-row 1
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
            font-size 26px
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

            p
                line-height 25px
                padding 10px 0

            .buttons
                display inline-flex
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
                mask-image linear-gradient(to bottom, rgb(0, 0, 0) 75%, transparent)

        li.border
            border-bottom none
            margin-bottom 30px
            padding-bottom 0

Section#sermon-series
    #cards
        display grid
        grid-gap 50px
        grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 250px)}, 1fr))
        padding 20px 50px
        width 100%

        .card
            align-items center
            display flex
            flex-flow column nowrap

        .card .image-wrapper
            box-shadow 0 0 1px #000
            overflow hidden
            width 100%

        .card img
            display block
            transition transform 0.2s
            width 100%

        .card span
            font-weight 600
            margin 10px 0
            padding 10px 0
            position relative

        .card:hover img
            transform scale(1.1)

        .card:hover span::after
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
        grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 300px)}, 1fr));
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
        align-items center
        display grid
        grid-column-gap 30px
        grid-row-gap 40px
        grid-template-columns min-content auto

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

            span
                white-space nowrap

            span.title
                font-size 18px

            span.subtitle
                color #444
                font-size 16px
                margin-top 5px

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

        #footer-secondary-items
            display grid
            grid-gap 40px
            grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 200px)}, 1fr))

            #item
                font-weight 300
                white-space nowrap

        h3
            font-size 16px
            margin 0 0 10px

        i
            font-size 22px
            padding 5px 20px 0 0

Section#copyright
    color #eee
    font-size 15px
    font-weight 300
    padding 20px 0
</style>
