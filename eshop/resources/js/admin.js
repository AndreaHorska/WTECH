document.addEventListener('DOMContentLoaded', function () {
    const thumbnails = document.querySelector('.thumbnails');
    const mainImage = document.getElementById('mainImage');

    if (!thumbnails) return;

    // Zobrazovanie hlavneho obrazku
    function setActiveThumb(img) {
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active'));
        img.classList.add('active');
        if (mainImage) mainImage.src = img.src;
    }

    // Preklikavanie medzi obrazkami
    thumbnails.querySelectorAll('img.thumb').forEach(img => {
        img.addEventListener('click', function (e) {
            e.stopPropagation();
            e.preventDefault();
            setActiveThumb(img);
        });
    });

    // Pri novom obrazku sa vytvori novy file input pre dalsi obrazok
    function attachFileInput(input) {
        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (ev) {

                // Novy wrapper
                const wrapper = document.createElement('div');
                wrapper.className = 'thumb-wrapper';

                // Novy img
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.className = 'thumb';

                img.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    setActiveThumb(img);
                });

                // Delete tlacidlo pre novy obrazok
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'thumb-delete';
                deleteBtn.textContent = '×';
                deleteBtn.addEventListener('click', function () {
                    wrapper.style.display = 'none';
                    input.disabled = true;
                });

                wrapper.appendChild(img);
                wrapper.appendChild(deleteBtn);

                const addButton = thumbnails.querySelector('.add-thumb');
                thumbnails.insertBefore(wrapper, addButton);
                setActiveThumb(img);

                // Novy file input pre dalsi obrazok
                const newInput = document.createElement('input');
                newInput.type = 'file';
                newInput.name = 'images[]';
                newInput.hidden = true;
                document.querySelector('.product_gallery').appendChild(newInput);

                document.querySelector('.add-thumb').onclick = function () {
                    newInput.click();
                };

                attachFileInput(newInput);
            };
            reader.readAsDataURL(file);
        });
    }

    // Listener na povodny file input
    const fileInput = document.getElementById('newImageInput');
    if (fileInput) {
        attachFileInput(fileInput);
    }
});