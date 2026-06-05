document.addEventListener('DOMContentLoaded', () => {

    const track = document.getElementById('track');

    if (!track) return;

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const dotsContainer = document.getElementById('indicators');
    const container = document.getElementById('carousel-container');

    let index = 0;

    const items = track.children;
    const itemsPerView = window.innerWidth >= 768 ? 3 : 1;
    const maxIndex = items.length - itemsPerView;

    let autoPlayInterval;

    for (let i = 0; i <= maxIndex; i++) {

        const dot = document.createElement('button');

        dot.className =
            `h-3 rounded-full transition-all duration-300 ${
                i === 0
                ? 'bg-blue-900 w-8'
                : 'bg-gray-300 w-3'
            }`;

        dot.addEventListener('click', () => {
            index = i;
            updateCarousel();
        });

        dotsContainer.appendChild(dot);
    }

    const dots = dotsContainer.children;

    function updateCarousel() {

        track.style.transform =
            `translateX(-${(index * 100) / itemsPerView}%)`;

        Array.from(dots).forEach((dot, i) => {

            dot.className =
                `h-3 rounded-full transition-all duration-300 ${
                    i === index
                    ? 'bg-blue-900 w-8'
                    : 'bg-gray-300 w-3'
                }`;

        });
    }

    function nextSlide() {
        index = index < maxIndex ? index + 1 : 0;
        updateCarousel();
    }

    function prevSlide() {
        index = index > 0 ? index - 1 : maxIndex;
        updateCarousel();
    }

    function startTimer() {
        autoPlayInterval = setInterval(nextSlide, 4000);
    }

    function resetTimer() {
        clearInterval(autoPlayInterval);
        startTimer();
    }

    nextBtn.addEventListener('click', () => {
        nextSlide();
        resetTimer();
    });

    prevBtn.addEventListener('click', () => {
        prevSlide();
        resetTimer();
    });

    container.addEventListener('mouseenter', () => {
        clearInterval(autoPlayInterval);
    });

    container.addEventListener('mouseleave', startTimer);

    startTimer();

});