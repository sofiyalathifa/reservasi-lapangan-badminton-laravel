document.addEventListener('DOMContentLoaded', () => {

    const track = document.getElementById('track');
    if (!track) return;

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const dotsContainer = document.getElementById('indicators');
    const container = document.getElementById('carousel-container');

    let index = 0;
    const allItems = track.children;
    let maxIndex = 0;
    let autoPlayInterval;

    function getItemsPerView() {
        return window.innerWidth >= 768 ? 3 : 1;
    }

    function initCarousel() {
        const visibleItems = Array.from(allItems).filter(item => item.style.display !== 'none');
        const itemsPerView = getItemsPerView();
        maxIndex = Math.max(0, visibleItems.length - itemsPerView);

        // Reset index if it's out of bounds
        if (index > maxIndex) index = maxIndex;

        // Render dots
        dotsContainer.innerHTML = '';
        if (maxIndex > 0) {
            for (let i = 0; i <= maxIndex; i++) {
                const dot = document.createElement('button');
                dot.className = `h-3 rounded-full transition-all duration-300 ${i === index ? 'bg-blue-900 w-8' : 'bg-gray-300 w-3'}`;
                dot.addEventListener('click', () => {
                    index = i;
                    updateCarousel();
                    resetTimer();
                });
                dotsContainer.appendChild(dot);
            }
            dotsContainer.style.display = 'flex';
            prevBtn.style.display = 'block';
            nextBtn.style.display = 'block';
            resetTimer();
        } else {
            dotsContainer.style.display = 'none';
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
            clearInterval(autoPlayInterval);
        }

        updateCarousel();
    }

    function updateCarousel() {
        const itemsPerView = getItemsPerView();
        track.style.transform = `translateX(-${(index * 100) / itemsPerView}%)`;

        const dots = dotsContainer.children;
        Array.from(dots).forEach((dot, i) => {
            dot.className = `h-3 rounded-full transition-all duration-300 ${i === index ? 'bg-blue-900 w-8' : 'bg-gray-300 w-3'}`;
        });
    }

    function nextSlide() {
        if (maxIndex <= 0) return;
        index = index < maxIndex ? index + 1 : 0;
        updateCarousel();
    }

    function prevSlide() {
        if (maxIndex <= 0) return;
        index = index > 0 ? index - 1 : maxIndex;
        updateCarousel();
    }

    function startTimer() {
        if (maxIndex > 0) {
            autoPlayInterval = setInterval(nextSlide, 4000);
        }
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

    container.addEventListener('mouseleave', () => {
        if (maxIndex > 0) startTimer();
    });

    window.addEventListener('resize', () => {
        initCarousel();
    });

    // Expose a global function to be called by filter-tabs.js
    window.refreshCarousel = () => {
        index = 0; // go back to start
        initCarousel();
    };

    // Initial setup
    initCarousel();

});