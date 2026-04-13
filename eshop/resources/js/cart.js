document.addEventListener("DOMContentLoaded", () => {

    function showToast(message, type = 'success') {
        document.getElementById('toast')?.remove();
        const toast = document.createElement('div');
        toast.id = 'toast';
        toast.className = `toast-notification ${type}`;
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.classList.add("show"), 100);
        setTimeout(() => {
            toast.classList.remove("show");
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    const savedScroll = sessionStorage.getItem('cartScrollY');
    if (savedScroll) {
        window.scrollTo(0, parseInt(savedScroll));
        sessionStorage.removeItem('cartScrollY');
    }

    const pickers = document.querySelectorAll(".quantity-picker");

    pickers.forEach((picker) => {
        const input = picker.querySelector(".quantity-input");
        const buttons = picker.querySelectorAll(".quantity-button");

        const decrease = buttons[0];
        const increase = buttons[1];

        async function submitQuantity() {
            await fetch(picker.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: new FormData(picker),
            });

            sessionStorage.setItem('cartScrollY', window.scrollY);
            location.reload();
        }

        decrease.addEventListener("click", () => {
            let value = parseInt(input.value, 10) || 1;
            input.value = Math.max(1, value - 1);
            submitQuantity();
        });

        increase.addEventListener("click", () => {
            let value = parseInt(input.value, 10) || 1;
            const max = parseInt(input.getAttribute('max'), 10);
            if (value >= max) {
                showToast('Maximum available quantity reached.', 'warning');
                return;
            }
            input.value = value + 1;
            submitQuantity();
        });

        input.addEventListener("input", () => {
            input.value = input.value.replace(/[^\d]/g, "");
        });

        input.addEventListener("blur", () => {
            if (input.value === "" || parseInt(input.value, 10) < 1) {
                input.value = 1;
            }
            submitQuantity();
        });
    });
});
