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
            touchEventX: null,
            touchEventY: null,
            touchDirection: null,
        }
    },
    mounted() {
        const slides = this.$refs.slides.children
        if (slides.length) {
            this.setupPagination()
            this.changeToSlide(0)

            this.$refs.slides.addEventListener('mouseenter', this.stopTimer, { passive: true })
            this.$refs.slides.addEventListener('mouseleave', this.restartTimer, { passive: true })
            this.$refs.slides.addEventListener('touchstart', this.handleTouchStart, false)
            this.$refs.slides.addEventListener('touchmove', this.handleTouchMove, false)
            this.$refs.slides.addEventListener('touchend', this.handleTouchEnd, false)
        }
    },
    beforeUnmount() {
        this.stopTimer()
        if (this.$refs.slides.children) {
            this.$refs.slides.removeEventListener('mouseenter', this.stopTimer)
            this.$refs.slides.removeEventListener('mouseleave', this.restartTimer)
            this.$refs.slides.removeEventListener('touchstart', this.handleTouchStart)
            this.$refs.slides.removeEventListener('touchmove', this.handleTouchMove)
            this.$refs.slides.removeEventListener('touchend', this.handleTouchEnd)
        }
    },
    methods: {
        setupPagination() {
            const slides = this.$refs.slides.children.length
            for (let i = 0; i < slides; ++i) {
                const button = document.createElement('button')
                button.addEventListener('click', () => this.changeToSlide(i))
                this.$refs.pagination.appendChild(button)
            }
        },
        changeToSlide(index) {
            this.stopTimer()
            this.$refs.slides.querySelector('.active')?.classList.remove('active')
            this.$refs.pagination.querySelector('.active')?.classList.remove('active')
            this.$refs.slides.children[index].classList.add('active')
            this.$refs.pagination.children[index].classList.add('active')
            this.index = index
            this.startTimer()
        },
        changeToNextSlide() {
            this.changeToSlide(this.nextSlideIndex())
        },
        changeToPrevSlide() {
            this.changeToSlide(this.prevSlideIndex())
        },
        startTimer() {
            this.timer = setTimeout(() => this.changeToSlide(this.nextSlideIndex()), 4000)
        },
        nextSlideIndex() {
            const slides = this.$refs.slides.children.length
            return this.index < slides - 1 ? this.index + 1 : 0
        },
        prevSlideIndex() {
            const slides = this.$refs.slides.children.length
            return this.index > 0 ? this.index - 1 : slides - 1
        },
        stopTimer() {
            if (this.timer)
                clearTimeout(this.timer)
        },
        restartTimer() {
            if (this.index !== null)
                this.startTimer()
        },
        handleTouchStart(event) {
            this.touchEventX = event.touches[0].clientX
            this.touchEventY = event.touches[0].clientY
        },
        handleTouchMove(event) {
            if (!this.touchEventX || !this.touchEventY)
                return

            var xUp = event.touches[0].clientX
            var yUp = event.touches[0].clientY

            var xDiff = this.touchEventX - xUp;
            var yDiff = this.touchEventY - yUp;

            if (Math.abs(xDiff) > Math.abs(yDiff)) {
                if (xDiff > 0) {
                    this.touchDirection = 'next'
                } else {
                    this.touchDirection = 'prev'
                }

                event.preventDefault()
            }

            this.touchEventX = null
            this.touchEventY = null
        },
        handleTouchEnd() {
            if (!this.touchDirection)
                return

            if (this.touchDirection == 'next') {
                this.changeToNextSlide();
            } else {
                this.changeToPrevSlide();
            }

            this.touchDirection = null
        }
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

    #pagination:deep(button:active), #pagination:deep(button.active)
        transform scale(1.3)
</style>
