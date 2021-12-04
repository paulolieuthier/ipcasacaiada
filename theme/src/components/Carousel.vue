<template>
    <div id="wrapper">
        <div id="slides" ref="slides">
            <slot />
        </div>
        <div id="pagination" ref="pagination" />
    </div>
</template>

<script>
import { ref } from 'vue'

export default {
    setup() {
        return {
            index: null,
            timer: null,
            slides: ref(null),
            pagination: ref(null),
        }
    },
    mounted() {
        const slides = this.$refs.slides.children
        if (slides.length) {
            this.setupPagination()
            this.changeSlide(0)

            const options = { passive: true }
            this.$refs.slides.addEventListener('mouseenter', this.stopTimer, options)
            this.$refs.slides.addEventListener('mouseleave', this.restartTimer, options)
        }
    },
    beforeUnmount() {
        this.stopTimer()
        if (this.$refs.slides.children) {
            this.$refs.slides.removeEventListener('mouseenter', this.stopTimer)
            this.$refs.slides.removeEventListener('mouseleave', this.restartTimer)
        }
    },
    methods: {
        setupPagination() {
            const slides = this.$refs.slides.children.length
            for (let i = 0; i < slides; ++i) {
                const button = document.createElement('button')
                button.addEventListener('click', () => this.changeSlide(i))
                this.$refs.pagination.appendChild(button)
            }
        },
        changeSlide(index) {
            this.stopTimer()
            this.$refs.slides.querySelector('.active')?.classList.remove('active')
            const slides = this.$refs.slides.children
            slides[index].classList.add('active')
            this.startTimer(index)
        },
        startTimer(index) {
            const nextSlideIndex = this.nextSlideIndex(index)
            this.timer = setTimeout(() => {
                this.index = nextSlideIndex
                this.changeSlide(nextSlideIndex)
            }, 4000)
        },
        nextSlideIndex(index) {
            const slides = this.$refs.slides.children.length
            return index < slides - 1 ? index + 1 : 0
        },
        stopTimer() {
            if (this.timer)
                clearTimeout(this.timer)
        },
        restartTimer() {
            if (this.index !== null)
                this.startTimer(this.index)
        },
    }
}
</script>

<style scoped lang="stylus">
#wrapper
    height 100%
    position relative
    width 100%

    #slides
        display grid
        height 100%

    #slides > ::v-slotted(*)
        display block
        grid-column 1
        grid-row 1
        height 100%
        width 100%

    #slides > ::v-slotted(*)
        opacity 0

    #slides > ::v-slotted(*).active
        animation fadein .5s linear 1 forwards

    @keyframes fadein
        0% { opacity: 0; }
        100% { opacity: 1; }

    #pagination
        bottom 0
        display block
        position absolute
        text-align center
        width 100%

    #pagination:deep(button)
        border 0
        border-radius 15px
        box-shadow 0 0 5px #888
        cursor pointer
        height 15px
        margin 10px 5px
        opacity 0.9
        width 15px

    #pagination:deep(button:hover)
        opacity 1

    #pagination:deep(button:active)
        transform scale(1.1)
</style>
