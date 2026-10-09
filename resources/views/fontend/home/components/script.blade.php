<!-- jQuery  -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<!-- jQurery Ui  -->
<script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"
    integrity="sha256-u0L8aA6Ev3bY2HI4y0CAyr9H8FRWgX4hZ9+K7C2nzdc=" crossorigin="anonymous"></script>
    
<!-- bootstrap5 js   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<!-- splide js  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/splidejs/4.1.4/js/splide.min.js"></script>
<!-- select2 js  -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- js  -->
<script type="module" src="/libaries/templates/bee-cloudy-user/libaries/js/script.js"></script>
{{-- <script src="/libaries/templates/bee-cloudy-user/libaries/js/danhgia.js"></script> --}}
<!-- jquery  -->
<script src="/libaries/templates/bee-cloudy-user/libaries/js/jquey_custom.js"></script>
<script src="/libaries/templates/bee-cloudy-user/libaries/js/posts.js"></script>
{{-- choose variant  --}}
<script src="/libaries/js/choose_variant.js"></script>
{{-- cart  --}}
<script src="/libaries/js/cart.js"></script>
{{-- wishlist  --}}
<script src="/libaries/js/wishlist.js"></script>
{{-- address  --}}
<script src="/libaries/js/address_vn.js"></script>
{{-- set up val order final  --}}
<script src="/libaries/js/val_order.js"></script>
{{-- set up val filter final  --}}
<script src="/libaries/js/filter_product.js"></script>
{{-- search  --}}
<script src="/libaries/js/search_suggestions.js"></script>
{{-- flaher notify  --}}
<script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
{{-- vue js  --}}
<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
{{-- @vite(['resources/js/app.js']) --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.11.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.11.5/dist/ScrollTrigger.min.js"></script>

<script>
    gsap.registerPlugin(ScrollTrigger);

    // Kiểm tra sự tồn tại của phần tử có lớp .parallax
    if (document.querySelector('.parallax')) {

        // Parallax effect
        gsap.to(".parallax", {
            backgroundPosition: "50% 100%",
            ease: "none",
            scrollTrigger: {
                trigger: ".parallax",
                start: "top top",
                end: "bottom top",
                scrub: true
            }
        });
    }

    // Animate vouchers on scroll nếu tồn tại .promotion-card
    if (document.querySelector('.promotion-card')) {
        gsap.utils.toArray(".promotion-card").forEach((card, i) => {
            gsap.from(card, {
                y: 100,
                opacity: 0,
                duration: 1,
                scrollTrigger: {
                    trigger: card,
                    start: "top bottom-=100",
                    toggleActions: "play none none reverse"
                }
            });
        });
    }

    // Countdown timer
    function updateCountdown() {
        const countdowns = document.querySelectorAll('.countdown div');
        countdowns.forEach(countdown => {
            const expires = new Date(countdown.dataset.expires);
            const now = new Date();
            const diff = expires - now;

            if (diff > 0) {
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                countdown.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
            } else {
                countdown.textContent = "Đã hết hạn";
            }
        });
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();

    // Modal functions
    function showModal(code) {
        const modal = new bootstrap.Modal(document.getElementById('voucherModal'));
        document.getElementById('modalVoucherCode').textContent = code;
        modal.show();
    }
</script>
