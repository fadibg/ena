const items = document.querySelectorAll('.carousel-item');
let currentIndex = 0;

function updateCarousel() {
    items.forEach((item, index) => {
        item.classList.remove('active'); // Remove active class from all items
    });
    items[currentIndex].classList.add('active'); // Add active class to current item
}

document.getElementById('prevBtn').addEventListener('click', function() {
    if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
    }
});

document.getElementById('nextBtn').addEventListener('click', function() {
    if (currentIndex < items.length - 1) {
        currentIndex++;
        updateCarousel();
    }
});

// Initialize first display
updateCarousel();
