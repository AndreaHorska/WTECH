document.addEventListener("DOMContentLoaded", () => {
    const pickers = document.querySelectorAll(".quantity-picker");

    pickers.forEach((picker) => {
        const input = picker.querySelector(".quantity-input");
        const buttons = picker.querySelectorAll(".quantity-button");

        const decrease = buttons[0];
        const increase = buttons[1];

        decrease.addEventListener("click", () => {
            let value = parseInt(input.value, 10) || 1;
            input.value = Math.max(1, value - 1);
        });

        increase.addEventListener("click", () => {
            let value = parseInt(input.value, 10) || 1;
            input.value = value + 1;
        });

        input.addEventListener("input", () => {
            input.value = input.value.replace(/[^\d]/g, "");
        });

        input.addEventListener("blur", () => {
            if (input.value === "" || parseInt(input.value, 10) < 1) {
                input.value = 1;
            }
        });
    });
});