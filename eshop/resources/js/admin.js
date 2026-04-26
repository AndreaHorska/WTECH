document.addEventListener('DOMContentLoaded', function () {
    const thumbnails = document.querySelector('.thumbnails');
    const mainImage = document.getElementById('mainImage');

    if (!thumbnails) return;

    function setActiveThumb(img) {
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        img.classList.add('active');
        if (mainImage) mainImage.src = img.src;
    }

    thumbnails.querySelectorAll('img.thumb').forEach(img => {
        img.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            setActiveThumb(img);
        });
    });

    function attachFileInput(input) {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'thumb';

                img.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    setActiveThumb(img);
                });

                const addButton = thumbnails.querySelector('.add-thumb');
                thumbnails.insertBefore(img, addButton);
                setActiveThumb(img);

                // Vytvor nový file input pre ďalší súbor
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'images[]';
                newInput.hidden = true;
                document.querySelector('.product_gallery').appendChild(newInput);

                // Presmeruj add-thumb na nový input
                document.querySelector('.add-thumb').onclick = function () {
                    newInput.click();
                };

                // Pridaj listener na nový input
                attachFileInput(newInput);
            };
            reader.readAsDataURL(file);
        });
    }

    const fileInput = document.getElementById('newImageInput');
    if (fileInput) {
        attachFileInput(fileInput);
    }
});