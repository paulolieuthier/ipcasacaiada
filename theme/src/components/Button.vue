<template>
    <a class="button" :href="link ?? '#'"><slot /></a>
</template>

<script>
export default {
    props: ['link'],
} 
</script>

<style scoped lang="stylus">
.button
    background transparent
    border-radius 0 !important
    border 2px solid #3069B3!important
    color #3069B3
    font-weight 600
    padding 12px !important
    text-decoration none
    white-space nowrap

.button:hover
    color white
    cursor pointer
    background #3069B3
</style>
