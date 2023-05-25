const ANIMATE_TIME = 1000

$(document).ready(() => {
    $('.carousel').carousel('pause');

    $('.carousel-control-prev').on('click', () => {
        let $currSlide = $('.carousel-item.active')
        let $prevSlide = $currSlide.prev()

        if ($prevSlide.length > 0) {
            $currSlide.animate(
                {
                    left: `+=${$currSlide.width()}`
                },
                ANIMATE_TIME,
                () => {
                    $currSlide.removeClass('active')
                    $currSlide.css({'left': '0'})
                    $prevSlide.addClass('active')
                }
            )
        }
    })

    $('.carousel-control-next').on('click', () => {
        let $currSlide = $('.carousel-item.active')
        let $nextSlide = $currSlide.next()

        if ($nextSlide.length > 0) {
            $currSlide.animate(
                {
                    left: `-=${$currSlide.width()}`
                },
                ANIMATE_TIME,
                () => {
                    $currSlide.removeClass('active')
                    $currSlide.css({'left': '0'})
                    $nextSlide.addClass('active')
                }
            )
        }
    })
})