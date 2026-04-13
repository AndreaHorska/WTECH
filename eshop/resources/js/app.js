import './bootstrap';

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

    function updateCartBadge(count) {
        const cartLink = document.querySelector('.cart');
        let badge = document.querySelector('.cart-badge');

        if (!cartLink) {
            return;
        }

        if (count > 0) {
            if (badge) {
                badge.textContent = count > 99 ? '99+' : count;
            } else {
                badge = document.createElement('span');
                badge.className = 'cart-badge';
                badge.textContent = count > 99 ? '99+' : count;
                cartLink.appendChild(badge);
            }
        } else if (badge) {
            badge.remove();
        }
    }

    async function refreshCartBadge() {
        try {
            const response = await fetch('/cart/count', {
                headers: {
                    'Accept': 'application/json',
                },
                cache: 'no-store',
            });

            if (!response.ok) {
                return;
            }

            const data = await response.json();
            updateCartBadge(data.count ?? 0);
        } catch {
        }
    }

    const existingToast = document.getElementById("toast");
    if (existingToast) {
        setTimeout(() => existingToast.classList.add("show"), 100);
        setTimeout(() => {
            existingToast.classList.remove("show");
            setTimeout(() => existingToast.remove(), 300);
        }, 3000);
    }

    document.body.addEventListener('submit', async (e) => {
        const form = e.target;
        if (!form.querySelector('[name="product_id"]')) return;
        if (form.closest('.product-card') === null) return;

        e.preventDefault();

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: new FormData(form),
            });

            const data = await response.json();

            if (data.success) {
                showToast(data.message ?? 'Added to cart!', 'success');
                updateCartBadge(data.cartCount ?? 0);
            } else if (data.warning) {
                showToast(data.warning, 'warning');
            } else if (data.error) {
                showToast(data.error, 'error');
            } else {
                showToast('Something went wrong.', 'error');
            }
        } catch {
            showToast('Something went wrong.', 'error');
        }
    });

    refreshCartBadge();

    window.addEventListener('pageshow', function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
});
