(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    FS.splideCarousel = () => {
        let mainCarousel = new Splide("#main-carousel", {
            type: "fade",
            heightRatio: 1,
            pagination: false,
            arrows: false,
            cover: false,
            // responsive image main
            breakpoints: {
                1200: { heightRatio: 0.75 }, // Cho col-lg-5
                900: { heightRatio: 0.5 }, // Cho col-md-4
                600: { heightRatio: 0.3 }, // Cho col-sm-12
                480: { heightRatio: 0.2 }, // Cho màn hình nhỏ hơn 480px
            },
        }).mount();

        let thumbnailCarousel = new Splide("#thumbnail-carousel", {
            fixedWidth: 100,
            fixedHeight: 60,
            gap: 10,
            rewind: true,
            pagination: false,
            // responsive image thumbnail
            breakpoints: {
                1200: { fixedWidth: 90, fixedHeight: 55 },
                900: { fixedWidth: 80, fixedHeight: 50 },
                600: { fixedWidth: 66, fixedHeight: 40 },
                480: { fixedWidth: 50, fixedHeight: 35 },
            },
        }).mount();

        // Đồng bộ hai băng chuyền
        mainCarousel.sync(thumbnailCarousel);
    };
    FS.selectVairantProduct = () => {
        if ($(".choose-attribute").length) {
            $(document).on("click", ".choose-attribute", function (e) {
                e.preventDefault();
                let _this = $(this);
                let attribute_id = _this.attr("data-attributeId");
                FS.handleAttribute();
            });
        }
    };
    FS.setupVariantGallery = (gallery) => {
        let html = `<div id="main-carousel" style="margin-bottom: 10px;" class="splide " aria-label="Main Carousel">
                        <div class="splide__track ">
                            <ul class="splide__list position-relative">`;
        gallery.forEach(function (image) {
            html += `<li class="splide__slide image-product image-product">
                        <img src="${image}" alt="${image}" class="img-fluid">
                     </li>`;
        });
        html += `</ul>
                <div class="box-favourite position-absolute z-3" data-bs-toggle="tooltip" data-bs-title="Thêm vào yêu thích">
                    <div class="position-relative">
                        <a href="#" class="position-absolute start-50 translate-middle" style="top: 20px;">
                            <i class="icon-favourite fa-regular fa-bookmark fz-20 text-muted"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="thumbnail-carousel" class="splide mb-5">
            <div class="splide__track">
                <ul class="splide__list">`;
        gallery.forEach(function (image) {
            html += `<li class="splide__slide image-product">
                        <img src="${image}" alt="${image}" class="img-fluid">
                     </li>`;
        });
        html += `</ul>
            </div>
        </div>`;

        if (gallery.length) {
            // Cập nhật lại HTML
            $(".galleryVariant").html(html);
            // gọi lại slipde hoạt động
            FS.splideCarousel();
        }
    };

    FS.handleAttribute = () => {
        let attribute_id = [];
        let flag = true;
        $(".attribute-value .choose-attribute").each(function (e) {
            // e.preventDefault();
            let _this = $(this);
            if (_this.hasClass("active")) {
                attribute_id.push(_this.attr("data-attributeId"));
            }
        });

        $(".attribute").each(function () {
            if ($(this).find(".choose-attribute.active").length === 0) {
                flag = false;
                return false;
            }
        });
        // gửi ajax lấy dữ liệu theo mảng attribute id
        if (flag) {
            $.ajax({
                url: "/ajax/product/loadVariant",
                type: "GET",
                data: {
                    attribute_id: attribute_id,
                    product_id: $('input[name="product_id"]').val(),
                },
                dataType: "json",

                success: function (res) {
                    // xử lý sau khi đã có dữ liệu trả về
                    let albumVariant = res.productVariant.album.split(",");
                    FS.setupVariantGallery(albumVariant);
                    FS.setUpVariantName(res)
                    FS.setUpVariantPrice(res)
                    FS.productVariantSold(res)
                },
            });
        }
    };
    FS.setUpVariantName = (res) => {
        let productVariantName = res.productVariant.name
        $('.product-variant-title').html(productVariantName)
    }
    FS.setUpVariantPrice = (res) => {
        let productVariantPrice = res.productVariant.price
        let productVariantPriceFormat = productVariantPrice.toLocaleString('de-DE')
        $('.product-variant-price').html(productVariantPriceFormat+'đ')
    }
    FS.productVariantSold = (res) => {
        let productVariantSold = res.productVariant.sold_count
        $('.product-variant-sold').html(productVariantSold)
    }
    FS.activeVariantFirst = () => {
        let attributeCatalogue = JSON.parse($('.attributeCatalogue').val())
        if(typeof attributeCatalogue != 'undefined' && attributeCatalogue.length) {
        FS.handleAttribute()
        }
    }
    // gọi hàm
    $(document).ready(function () {
        FS.selectVairantProduct();
        FS.activeVariantFirst()
    });
})(jQuery);
