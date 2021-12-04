<template>
    <template v-if="!loading">
        <div>
            <a class="anchor" id="inicio" ref="inicio" />
            <Section id="banner-wrapper" class="fill gray borderless">
                <div id="banner" :style="`background-image: url('${data.banner}')`" />
            </Section>

            <Section id="content" class="spacing center" flow="column" :title="'Série: ' + data.title">
                <div id="series">
                    <div id="metadata">
                        <img :src="data.image" />
                        <div v-html="data.description" />
                    </div>
                    <div id="sermons">
                        <ul>
                            <template v-for="(sermon, index) in data.sermons" :key="sermon.slug">
                                <li>
                                    <div class="header">
                                        <button class="play" :onclick="play" :data-sermon-content="'sermon-content-' + index">
                                            <span class="fa-stack">
                                                <i class="fas fa-circle fa-stack-1x fa-inverse"></i>
                                                <i class="fas fa-play-circle fa-stack-1x" />
                                            </span>
                                        </button>
                                        <div class="sermon">
                                            <p class="title"><b>{{ sermon.title }}</b></p>
                                            <p class="metadata">
                                                <span><b>Texto:</b> {{ sermon.passage }}</span>
                                                <span><b>Pregador:</b> {{ sermon.preacher }}</span>
                                                <span><b>Data:</b> {{ sermon.date.toLocaleDateString() }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div :id="'sermon-content-' + index" class="content" v-html="sermon.embedCode" />
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </Section>
        </div>
    </template>
</template>

<script>
import Section from '../Section.vue'

import { watchEffect } from 'vue'
import Querier from '../../querier.js'

export default {
    components: {
        Section,
    },
    props: ['serie'],
    emits: ['pageLoaded', 'scrolledToSection'],
    setup(props) {
        const { loading, data } = Querier.sermonSerie(props.serie)

        return {
            loading,
            data
        }
    },
    mounted() {
        watchEffect(() => this.loading || this.$nextTick(() => this.onDataMounted()), { flush: 'post' })
    },
    methods: {
        onDataMounted() {
            this.$emit('pageLoaded')
        },

        play(event) {
            this.$el.querySelector('#' + event.target.dataset.sermonContent).classList.toggle('active')
        }
    },
}
</script>

<style scoped lang="stylus">
#banner-wrapper
    height 200px

    #banner
        background-position center center
        background-size cover
        height 100%
        width 100%

#series
    display grid
    grid-gap 60px
    grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 250px)}, 1fr))
    padding 0 40px
    width 100%

    #metadata
        align-items end
        display flex
        flex-flow column nowrap
        gap 30px
        text-align end
        white-space pre-line

        img
            width @css{min(250px, 100%)}


    @media (max-width: 640px)
        #metadata
            align-items center
            text-align start

    #sermons
        ul
            list-style none
            margin 0
            padding 0

            li
                border-bottom 1px solid #ccc
                padding 15px 0

                .header
                    display flex
                    flex-flow row nowrap
                    gap 15px

                    .play
                        align-self start
                        background none
                        border none
                        filter drop-shadow(0 2px 0px #AAA)
                        font-size 2em
                        height 1em
                        padding 10px 0 0 0
                        width 1em

                        .fa-stack
                            height 1em
                            pointer-events none
                            width 1em

                        i
                            height 1em
                            line-height 1em
                            pointer-events none
                            width 1em

                    .play:hover
                        cursor pointer

                    .play:active
                        filter drop-shadow(0 1px 0px #AAA)
                        transform translateY(1px)

                    .sermon
                        display flex
                        flex-flow column nowrap
                        gap 10px
                        width 100%

                        p
                            margin 0

                        p.title
                            padding-left 5px

                        p.metadata
                            display flex
                            flex-flow row wrap
                            gap 10px 15px

                            span
                                background #eee
                                border-radius 15px
                                padding 5px 10px
                                font-size 12px

                .content
                   height 0
                   margin 0
                   overflow hidden
                   padding-bottom 0
                   position relative
                   transition margin .2s, padding-bottom .2s
                   width 100%

                .content.active
                   margin 15px 0
                   padding-bottom 56.25%
                   transition margin .1s, padding-bottom .2s

                .content:deep(iframe)
                   height 100% !important
                   left 0
                   position absolute
                   top 0
                   width 100% !important

            li:first-child
                padding-top 0

            li:last-child
                border none
                padding-bottom 0
</style>
