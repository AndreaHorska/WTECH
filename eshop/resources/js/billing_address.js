document.addEventListener('DOMContentLoaded', () => {
    const billingCheckbox = document.getElementById('toggle-billing');
    const billingSection = document.getElementById('billing-section');

    billingCheckbox.addEventListener('change', function() {
        if (this.checked) {
            billingSection.classList.remove('hidden');
        } else {
            billingSection.classList.add('hidden');
        }
    });
});
