document.addEventListener('DOMContentLoaded', () => {
    const layout = document.querySelector('.cart-shipping-layout');

    if (!layout) {
        return;
    }

    const token = document.querySelector('meta[name="csrf-token"]')?.content;

    const subtotal = Number(layout.dataset.subtotal || 0);

    const deliveryPriceEl = document.getElementById('deliveryPrice');
    const paymentPriceEl = document.getElementById('paymentPrice');
    const totalPriceEl = document.getElementById('totalPrice');

    const deliveryInputs = document.querySelectorAll('input[name="delivery"]');
    const paymentInputs = document.querySelectorAll('input[name="payment"]');

    function formatPrice(value) {
        return `${value.toFixed(2).replace('.', ',')} €`;
    }

    function getSelectedFee(inputs) {
        const selected = Array.from(inputs).find((input) => input.checked);
        return selected ? Number(selected.dataset.fee || 0) : 0;
    }

    function updateSummary() {
        const deliveryFee = getSelectedFee(deliveryInputs);
        const paymentFee = getSelectedFee(paymentInputs);

        const total = subtotal + deliveryFee + paymentFee;

        if (deliveryPriceEl) {
            deliveryPriceEl.textContent = formatPrice(deliveryFee);
        }

        if (paymentPriceEl) {
            paymentPriceEl.textContent = formatPrice(paymentFee);
        }

        if (totalPriceEl) {
            totalPriceEl.textContent = formatPrice(total);
        }
    }

    async function saveOption(data) {
        try {
            await fetch('/cart/shipping/save-option', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json',
                },
                body: data,
            });
        } catch (error) {
            console.error(error);
        }
    }

    async function saveDelivery(value = '') {
        const data = new FormData();
        data.append('delivery', value);
        await saveOption(data);
    }

    async function savePayment(value = '') {
        const data = new FormData();
        data.append('payment', value);
        await saveOption(data);
    }

    // odkliknutie, NA TEST !!!!!
    function enableUncheckRadios(inputs, saveFn) {
        inputs.forEach((radio) => {
            radio.addEventListener('click', async function () {
                if (this.checked && this.dataset.clicked === 'true') {
                    this.checked = false;
                    this.dataset.clicked = 'false';

                    await saveFn('');
                } else {
                    document.querySelectorAll(`input[name="${this.name}"]`).forEach((r) => {
                        r.dataset.clicked = 'false';
                    });

                    this.dataset.clicked = 'true';

                    await saveFn(this.value);
                }

                updateSummary();
            });
        });
    }

    // odkliknutie, NA TEST !!!!!
    enableUncheckRadios(deliveryInputs, saveDelivery);
    enableUncheckRadios(paymentInputs, savePayment);

    updateSummary();
});
