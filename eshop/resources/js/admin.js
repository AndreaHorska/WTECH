document.addEventListener('DOMContentLoaded', function () {
    const thumbnails = document.querySelector('.thumbnails');
    const mainImage = document.getElementById('mainImage');

    if (!thumbnails) return;

    /* Pridanie noveho obrazka */
    thumbnails.addEventListener('change', function (e) {
        if (e.target.type !== 'file') return;
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'thumb active';

            const addButton = thumbnails.querySelector('.add-thumb');
            thumbnails.insertBefore(img, addButton);

            if (mainImage) mainImage.src = e.target.result;
            document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
            img.classList.add('active');
        };
        reader.readAsDataURL(file);
    });
});