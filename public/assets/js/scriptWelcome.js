const imageCarousel = () => ({
    activeSlide: 0,
    slides: [],

    loadImages() {
        this.slides = [{
            image: 'https://picsum.photos/id/1025/800/400',
            description: 'Combo'
        },
        {
            image: 'https://picsum.photos/id/1015/800/401',
            description: 'Ala Carte'
        },
        {
            image: 'https://picsum.photos/id/1025/800/402',
            description: 'Drink'
        },
        {
            image: 'https://picsum.photos/id/1019/800/403',
            description: 'Snack'
        },
        ];
    },

    nextSlide() {
        this.activeSlide = (this.activeSlide + 1) % this.slides.length;
    },

    prevSlide() {
        this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
    },
});
$(document).ready(function () {
    $('a[href="#menu"], a[href="#about"]').click(function (event) {
        event.preventDefault();
        var target = $(this.hash);
        $('html, body').animate({
            scrollTop: target.offset().top
        }, 1000);
    });
});
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}