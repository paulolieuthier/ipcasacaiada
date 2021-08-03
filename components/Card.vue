<template>
    <div class="card">
        <div class="image-wrapper">
            <img :src="imagesrc" />
        </div>
        <template v-if="title">
            <span>{{ title }}</span>
        </template>
    </div>
</template>

<script>
export default {
    props: ['imagesrc', 'title', 'cursor'],
    data() {
        return {}
    }
}
</script>

<style scoped lang="stylus">
.card
    align-items center
    display flex
    flex-flow column nowrap
    padding 25px

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

</style>
