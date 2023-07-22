
// Carousel Slide Effect
const carousel = document.getElementById('carouselExample');
let isSliding = false;
carousel.addEventListener('slide.bs.carousel', () => {
        if (!isSliding) {
                isSliding = true;
                carousel.querySelectorAll('.carousel-item').forEach(item => {
                        item.classList.add('sliding');
                });
        }
});
carousel.addEventListener('slid.bs.carousel', () => {
        isSliding = false;
        carousel.querySelectorAll('.carousel-item').forEach(item => {
                item.classList.remove('sliding');
        });
});

// Show arrows on hover
document.getElementById('carouselExample').addEventListener('mouseenter', function () {
        document.querySelector('.carousel-control-prev').style.display = 'block';
        document.querySelector('.carousel-control-next').style.display = 'block';
});

document.getElementById('carouselExample').addEventListener('mouseleave', function () {
        document.querySelector('.carousel-control-prev').style.display = 'none';
        document.querySelector('.carousel-control-next').style.display = 'none';
});
