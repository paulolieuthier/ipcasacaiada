<template>
    <section class="wrapper">
        <section id="main" :class="flow">
            <h2 v-if="title">{{title}}</h2>
            <slot />
        </section>
    </section>
</template>
  
<script>
export default {
    props: ['title', 'flow'],
} 
</script>
  
<style scoped lang="stylus">
.wrapper
    border-top 1px solid #ededed
    display flex
    justify-content space-around
    width 100%

.wrapper.fill
    justify-content center

    #main
        max-width 1920px
        width 100%

.wrapper.borderless
    border-top none

.wrapper.alternate
    background #fafafa

.wrapper.dark
    background #211b1a

.wrapper.darker
    background #050505
    border: none

.wrapper.light-gray
    background #f9f9f9

.wrapper.gray
    background #464646

.wrapper.spacing
    padding-bottom 60px
    padding-top 60px

.wrapper.spacing-top
    padding-top 60px

.wrapper.center #content
    justify-content space-around

#main
    align-items center
    display flex
    height 100%
    justify-content space-between
    max-width 1300px
    width 100%

#main.row
    flex-flow row nowrap

#main.column
    flex-flow column nowrap

#main > h2
    text-align center
    margin 0 0 40px

#main > h2::after
    background #3069b3
    content ''
    display block
    width 105%
    height 4px
    margin 5px 0 0 -2.5%
</style>
