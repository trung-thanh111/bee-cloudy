document.addEventListener("DOMContentLoaded", function () {
  new Splide("#promo-carousel", {
    type: "loop", // Loại carousel (có thể sử dụng loop để liên tục cuộn)
    perPage: 1, // Số lượng slide hiển thị trên mỗi lượt trượt
    autoplay: true, // Tự động chuyển slide
    pauseOnHover: false,
    direction: "ttb", // Chuyển đổi từ trên xuống (top to bottom)
    height: "20px",
    width: "50%", // Chiều cao của carousel
    arrows: false, // Ẩn nút điều hướng
    pagination: false, // Ẩn các chấm chuyển trang
  }).mount();
});
// tooltip
const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// positon fixed menu
window.addEventListener("scroll", function () {
  var navbar = document.querySelector("nav");
  if (window.scrollY > 200) {
    navbar.classList.add(
      "fixed-top",
      "animate__animated",
      "animate__slideInDown"
    );
  } else {
    navbar.classList.remove(
      "fixed-top",
      "animate__animated",
      "animate__slideInDown"
    );
  }
});
// băng chuyền hình ảnh detail
document.addEventListener("DOMContentLoaded", function () {
  // image main
  var mainCarousel = document.querySelector("#main-carousel");
  if (mainCarousel) {
    mainCarousel = new Splide(mainCarousel, {
      type: "fade",
      heightRatio: 1,
      pagination: false,
      arrows: false,
      cover: false,
      // reponsive image main
      breakpoints: {
        1200: {
          heightRatio: 0.75, // Cho col-lg-5x
        },
        900: {
          heightRatio: 0.5, // Cho col-md-4
        },
        600: {
          heightRatio: 0.3, // Cho col-sm-12
        },
        480: {
          heightRatio: 0.2, // Màn hình nhỏ hơn 480px
        },
      },
    }).mount();
  }

  // Thumbnail carousel
  var thumbnailCarousel = document.querySelector("#thumbnail-carousel");
  if (thumbnailCarousel) {
    thumbnailCarousel = new Splide(thumbnailCarousel, {
      fixedWidth: 100,
      fixedHeight: 60,
      gap: 10,
      rewind: true,
      pagination: false,
      //reponsive image thumbnail
      breakpoints: {
        1200: {
          fixedWidth: 90, // Cho col-lg-5
          fixedHeight: 55,
        },
        900: {
          fixedWidth: 80, // Cho col-md-4
          fixedHeight: 50,
        },
        600: {
          fixedWidth: 66, // Cho col-sm-12
          fixedHeight: 40,
        },
        480: {
          fixedWidth: 50, // Màn hình nhỏ hơn 480px
          fixedHeight: 35,
        },
      },
    }).mount();
  }
  // Đồng bộ hai băng chuyền
  if (mainCarousel && thumbnailCarousel) {
    mainCarousel.sync(thumbnailCarousel);
  }
});
// prodcut
document.addEventListener("DOMContentLoaded", function () {
  let thumbnail_carousel2 = document.querySelector("#thumbnail-carousel2");
  if (thumbnail_carousel2) {
    new Splide(thumbnail_carousel2, {
      type: "slide",
      autoplay: 3000,
      gap: 10,
      perPage: 4, // hiển thị 4 item
      perMove: 1, // di chuyển 1 lần 1 item
      rewind: true,
      pagination: true,
      isNavigation: false,
      breakpoints: {
        600: {
          perPage: 2,
          gap: 5,
        },
        1024: {
          perPage: 3,
        },
      },
    }).mount();
  }
});
// post
document.addEventListener("DOMContentLoaded", function () {
  let thumbnail_carousel2 = document.querySelector("#thumbnail-carousel3");
  if (thumbnail_carousel2) {
    new Splide(thumbnail_carousel2, {
      type: "slide",
      autoplay: 3000,
      gap: 10,
      perPage: 7, // hiển thị 4 item
      perMove: 1, // di chuyển 1 lần 1 item
      rewind: true,
      height: 240,
      pagination: true,
      isNavigation: false,
      breakpoints: {
        600: {
          perPage: 3,
          gap: 5,
        },
        780: {
          perPage: 4,
        },
        1024: {
          perPage: 5,
        },
        1200: {
          perPage: 6,
        },
      },
    }).mount();
  }
});
document.addEventListener("DOMContentLoaded", function () {
  // image main
  var mainCarousel = document.querySelector("#main-carousel2");
  if (mainCarousel) {
    mainCarousel = new Splide(mainCarousel, {
      type: "slide",
      autoplay: 5000,
      gap: 10,
      perPage: 1, 
      perMove: 1,
      rewind: true,
      height: 580,
      pagination: true,
      isNavigation: false,
      heightRatio: 1,
      pagination: true,
      arrows: true,
      cover: false,
      // reponsive image main
      breakpoints: {
        1200: {
          heightRatio: 0.75,
        },
        900: {
          heightRatio: 0.5,
        },
        600: {
          heightRatio: 0.3,
        },
        480: {
          heightRatio: 0.2, // Màn hình nhỏ hơn 480px
        },
      },
    }).mount();
  }
});