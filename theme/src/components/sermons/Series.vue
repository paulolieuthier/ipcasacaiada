<template>
    <template v-if="!loading">
        <div>
            <Section id="banner-wrapper" class="fill gray borderless">
                <div id="banner" :style="`background-image: url('${data.banner}')`" />
            </Section>

            <Section id="content" class="spacing center" flow="column" title="Séries de Sermões">
                <div id="cards">
                    <template v-for="series in data.sermons" :key="series.slug">
                        <a id="card" :href="`/sermoes/series/${series.slug}`">
                            <div class="image-wrapper">
                                <img :src="series.image" />
                            </div>
                            <span>{{ series.name }}</span>
                        </a>
                    </template>
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
    emits: ['pageLoaded', 'scrolledToSection'],
    setup() {
        const { loading, data } = Querier.sermonSeries()

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
            console.log(this.data)
        },
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

Section#content
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

    @media (max-width: 740px)
        #cards
            grid-template-columns repeat(auto-fit, minmax(@css{min(100%, 140px)}, 1fr))
            grid-gap 30px
</style>
