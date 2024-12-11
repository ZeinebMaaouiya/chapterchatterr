document.getElementById('btn').addEventListener('click', function () {
    this.classList.toggle('click');
    document.getElementById('sb').classList.toggle('show'); // Updated to match your sidebar id
});

document.getElementById('admin-btn').addEventListener('click', function () {
    document.querySelector('.admin-show').classList.toggle('show'); // Updated for consistency
    document.getElementById('first').classList.toggle('rotate');
});
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', function () {
        const rating = this.getAttribute('data-value');
        const bookId = document.getElementById('rating-section').getAttribute('data-book-id');

        fetch('/bookrating/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ book_id: bookId, rating: rating }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                loadRating(bookId);
            } else {
                alert(data.message);
            }
        });
    });
});

function loadRating(bookId) {
    fetch(`/bookrating/getRating/${bookId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('average-rating').textContent =
                `Average Rating: ${data.averageRating.toFixed(1)} (${data.ratingCount} ratings)`;
        });
}

document.addEventListener('DOMContentLoaded', function () {
    const bookId = document.getElementById('rating-section').getAttribute('data-book-id');
    loadRating(bookId);
});

