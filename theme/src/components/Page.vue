<template>
    <template v-if="!loading">
        <div>
            <a class="anchor" id="inicio" ref="inicio" />
            <Section id="banner-wrapper" class="fill gray borderless">
                <div id="banner" :style="`background-image: url('${data.banner}')`" />
            </Section>

            <Section id="content" class="spacing center" flow="column" :title="data.title">
                <div v-html="data.content" />
            </Section>
        </div>
    </template>
</template>

<script>
import Section from './Section.vue'

import { watchEffect } from 'vue'
import Querier from '../querier.js'

export default {
    components: {
        Section,
    },
    props: ['uri'],
    emits: ['pageLoaded', 'scrolledToSection'],
    setup(props) {
        const uri = '/' + props.uri.join('/')
        const { loading, data } = Querier.page(uri)

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
            console.log('data', this.data)
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

Section#content
    padding-left 20px
    padding-right 20px
</style>
