let likeCount = 0;
const likeBtn = document.getElementById('likeBtn');
const likeCountDisplay = document.getElementById('likeCount');

likeBtn.addEventListener('click', function () {
    this.classList.toggle('liked');
    if (this.classList.contains('liked')) {
        likeCount++;
    } else {
        likeCount--;
    }
    likeCountDisplay.textContent = likeCount;
});

// ===============================

function toggleMenu() {
    var menu = document.getElementById("menu");
    menu.classList.toggle("show");
}

window.onclick = function (event) {
    if (!event.target.matches('.dots-icon')) {
        var dropdowns = document.getElementsByClassName("dropdown-menu");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
