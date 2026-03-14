document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', (e) => {

        if (e.target.closest('.add-to-cart')) return;

        const url = card.dataset.href;

        if (url) {
            window.location.href = url;
        }
    });
});