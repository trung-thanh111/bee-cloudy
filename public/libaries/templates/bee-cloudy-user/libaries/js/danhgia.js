// const stars = document.querySelectorAll('.star');
// const ratingResult = document.getElementById('rating-result');

// stars.forEach(star => {
//     star.addEventListener('click', () => {
//         const value = star.getAttribute('data-value');

//         stars.forEach(s => {
//             s.classList.remove('selected');
//         });

//         for (let i = 0; i < value; i++) {
//             stars[i].classList.add('selected');
//         }

//         ratingResult.textContent = value;
//     });
// });
const ratingSelect = document.getElementById('rating-select');
const ratingResult = document.getElementById('rating-result');

ratingSelect.addEventListener('change', () => {
    const value = ratingSelect.value;
    ratingResult.textContent = value;
});
