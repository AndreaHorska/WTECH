document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', (e) => {

        if (e.target.closest('.add-to-cart')) return;

        const url = card.dataset.href;

        if (url) {
            window.location.href = url;
        }
    });
});

/* Product images */
const thumbnails = document.querySelectorAll(".thumb");
const mainImage = document.getElementById("mainImage");

thumbnails.forEach(thumb => {
  thumb.addEventListener("click", () => {
    mainImage.src = thumb.src;
    thumbnails.forEach(t => t.classList.remove("active"));
    thumb.classList.add("active");
  });
});

document.addEventListener("DOMContentLoaded", function () {
    const toast = document.getElementById('my-toast');
    if (toast) {
        setTimeout(() => {
            toast.style.opacity = "0";
        }, 3000);
    }
});