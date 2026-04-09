const slider = document.getElementById("slider");
const minHandle = document.getElementById("minHandle");
const maxHandle = document.getElementById("maxHandle");
const progress = document.getElementById("progress");
const minInput = document.getElementById("minInput");
const maxInput = document.getElementById("maxInput");
const maxValue = Number(maxInput.max);
const ratingInput = document.getElementById("ratingInput");
const filterForm = document.getElementById("filterForm");

const state = {
    min: Number(minInput.value),
    max: Number(maxInput.value)
};

const stars = document.querySelectorAll(".star-filter");


function updateUI() {
    const sliderWidth = slider.offsetWidth;

    const minPx = (state.min / maxValue) * sliderWidth;
    const maxPx = (state.max / maxValue) * sliderWidth;

    minHandle.style.left = minPx + "px";
    maxHandle.style.left = maxPx + "px";

    progress.style.left = minPx + "px";
    progress.style.width = (maxPx - minPx) + "px";

    minInput.value = state.min;
    maxInput.value = state.max;
}

function startDrag(handle, isMin) {
    function onMove(e) {

        /* rect ziska poziciu na obrazovke - left + width, kde slider zacina a sirku */
        const rect = slider.getBoundingClientRect();
        let x = e.clientX - rect.left;
        let percent = x / rect.width;
        let value = Math.round(percent * maxValue);

        if (isMin) {
            if (value >= state.max) return;
            if (value < 0) value = 0;

            state.min = value;
        } else {
            if (value <= state.min) return;
            if (value > maxValue) value = maxValue;

            state.max = value;
        }

        updateUI();
    }

    function stop() {
        document.removeEventListener("mousemove", onMove);
        document.removeEventListener("mouseup", stop);
    }

    document.addEventListener("mousemove", onMove);
    document.addEventListener("mouseup", stop);

}

minHandle.addEventListener("mousedown", () => {
    startDrag(minHandle, true)
});


maxHandle.addEventListener("mousedown", () => {
    startDrag(maxHandle, false)
});


slider.addEventListener("mousedown", (e) => {
    if (e.target.classList.contains("handle")) return;

    const rect = slider.getBoundingClientRect();
    const clickX = e.clientX - rect.left;
    const clickPercent = clickX / rect.width;
    const clickValue = Math.round(clickPercent * maxValue);

    let activeHandle;

    if (Math.abs(clickValue - state.min) < Math.abs(clickValue - state.max)) {
        if (clickValue >= state.max) return;
        state.min = clickValue;
        activeHandle = minHandle;
    } else {
        if (clickValue <= state.min) return;
        state.max = clickValue;
        activeHandle = maxHandle;
    }

    updateUI();
    startDrag(activeHandle, activeHandle === minHandle);
});


minInput.addEventListener("change", () => {

    let value = Number(minInput.value);

    if (isNaN(value)) return;

    if (value < 0) value = 0;
    if (value >= state.max) value = state.max - 1;

    state.min = value;

    updateUI();
});


maxInput.addEventListener("change", () => {

    let value = Number(maxInput.value);

    if (isNaN(value)) return;

    if (value > maxValue) value = maxValue;
    if (value <= state.min) value = state.min + 1;

    state.max = value;

    updateUI();
});

updateUI();

function fillStars(index) {
    stars.forEach((s, i) => {
        if (i <= index) {
            s.classList.add('filled');
        } else {
            s.classList.remove('filled');
        }
    });

    /* indexuje sa od 0 */
    ratingInput.value = index + 1;
}

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        fillStars(index);
    });
});

const initialRating = Number(ratingInput.value);

if (!isNaN(initialRating) && initialRating > 0) {
    fillStars(initialRating - 1);
} else {
    ratingInput.value = 0;
}

window.addEventListener("resize", updateUI);
