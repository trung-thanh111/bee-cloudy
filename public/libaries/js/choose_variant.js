(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    FS.splideCarousel = () => {
        let mainCarousel = new Splide("#main-carousel", {
            type: "fade",
            autoplay: true,
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
            pagination: true,
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
            $(document).on("click", ".choose-attribute", function (e, res) {
                e.preventDefault();
                let _this = $(this);
                let attribute_id = _this.attr("data-attributeId");
                FS.handleAttribute();
            });
        }
    };
    // console.log(productWishlistId)
    FS.setupVariantGallery = (res) => {
        
        let product_id = $(".product_id_wishlist").html() ?? null;
        // bắt mảng id từ blade và loại bỏ null
        let WishlistId = productInWishlist.filter((id) => id != null);
        let albumVariant = res.productVariant.album.split(",");
        let promotionDetail = (product.del != 0 && product.del != null) ? ((product.price - res.productVariant.price)/product.price)*100 : '0';
        
        let html = `<div id="main-carousel" style="margin-bottom: 10px;" class="splide " aria-label="Main Carousel">
                        <div class="splide__track ">
                            <ul class="splide__list position-relative">`;
        albumVariant.forEach(function (image) {
            html += `<li class="splide__slide image-product image-product">
                        <img src="${image}" alt="${image}" class="img-fluid">
                     </li>`;
        });
        html += `</ul>
            <div class="d-flex justify-content-between">
                <div>
                    <div class="mini-coupon z-3 ${promotionDetail == 0 ? 'hidden-visibility' : '' }">${Math.ceil(promotionDetail)}%</div>
                </div>
                <div class="box-favourite position-absolute z-3 toggleWishlist" data-bs-toggle="tooltip" data-bs-title="${
                    WishlistId.includes(res.productVariant.id)
                        ? "Xóa khỏi yêu thích"
                        : "Thêm vào yêu thích"
                }" >
                    <div class="position-relative">
                        <a href="#" class="position-absolute start-50 translate-middle border-0 bg-white p-0" style="top: 20px;">
                            <i class="icon-favourite fa-${
                                WishlistId.includes(res.productVariant.id)
                                    ? "solid"
                                    : "regular"
                            } fa-bookmark fz-20 text-muted"></i>
                        </a>
                    </div>
                   <span class="product_variant_id_wishlist d-none">${
                       res.productVariant ? res.productVariant.id : ""
                   }</span>
                    <span class="product_id_wishlist d-none">${product_id}</span>
                </div>
            </div>
            </div>
        </div>
        <div id="thumbnail-carousel" class="splide mb-5">
            <div class="splide__track">
                <ul class="splide__list">`;
        albumVariant.forEach(function (image) {
            html += `<li class="splide__slide image-product">
                        <img src="${image}" alt="${image}" class="img-fluid">
                     </li>`;
        });
        html += `</ul>
            </div>
        </div>
        <div class="box-sku d-flex justify-content-between align-items-center">
                            <div class="detail-sku">
                                <span class="fz-14">
                                    <span>Sku: </span>
                                    <strong>${res.productVariant.sku}</strong>
                                </span>
                            </div>
                            <div class="share">
                                <span class="fz-14">
                                    <ul class="p-0 d-flex justify-content-around align-items-center w-75"
                                        <li class="list-unstyled mx-2">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(
                                                window.location.href
                                            )}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/color/25/facebook.png" alt="facebook"
                                                    data-bs-toggle="tooltip" data-bs-title="Chia sẻ lên Facebook" />
                                            </a>
                                        </li>
                                        <li class="list-unstyled mx-2">
                                            <a href="https://www.messenger.com/t?link=${encodeURIComponent(
                                                window.location.href
                                            )}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/fluency/25/facebook-messenger--v2.png"
                                                    alt="facebook-messenger--v2" data-bs-toggle="tooltip"
                                                    data-bs-title="Chia sẻ qua Messenger" />
                                            </a>
                                        </li>
                                        <li class="list-unstyled mx-2">
                                            <a href="https://zalo.me/share?url=${encodeURIComponent(
                                                window.location.href
                                            )}"
                                                target="_blank" class="text-decoration-none text-dark fz-20 fw-normal">
                                                <img width="25" height="25"
                                                    src="https://img.icons8.com/color/25/zalo.png" alt="zalo"
                                                    data-bs-toggle="tooltip" data-bs-title="Chia sẻ qua Zalo" />
                                            </a>
                                        </li>
                                    </ul>
                                </span>
                            </div>
                        </div>
        `;

        if (albumVariant.length) {
            // cập nhật lại html
            $(".galleryVariant").html(html);
            // gọi lại slipde hoạt động
            FS.splideCarousel();
        }
    };

    FS.handleAttribute = (res) => {
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
                    FS.setupVariantGallery(res);
                    FS.setUpVariantId(res);
                    FS.setUpVariantName(res);
                    FS.setUpVariantPrice(res);
                    FS.productVariantSold(res);
                    FS.quantityProductVariantMax(res);
                    FS.quantityInsockVariant(res);
                },
            });
        }
    };
    FS.setUpVariantId = (res) => {
        let productVariantId = res.productVariant.id;
        $(".product-variant-id").html(productVariantId);
    };
    FS.setUpVariantName = (res) => {
        let productVariantName = res.productVariant.name;
        $(".product-variant-title").html(productVariantName);
    };
    FS.setUpVariantPrice = (res) => {
        let productVariantPrice = res.productVariant.price;
        let productPrice = product.price
        let productVariantPriceFormat =
        productVariantPrice.toLocaleString("de-DE");
        let productPriceFormat =
        productPrice.toLocaleString("de-DE");
            let html = `<del class="product-price fw-normal text-muted fz-16 ${(productPrice == productVariantPrice) ? 'd-none' : ''}">${'           - ' + productPriceFormat+"đ"}</del>`
        
        $(".product-variant-price").html(productVariantPriceFormat + "đ"+ html);
    };
    FS.productVariantSold = (res) => {
        let productVariantSold = res.productVariant.sold_count;
        $(".product-variant-sold").html(productVariantSold+ ' ' + 'Sản phẩm');
    };
    FS.activeVariantFirst = () => {
        if ($(".attributeCatalogue").length) {
            let attributeCatalogue = JSON.parse($(".attributeCatalogue").val());
            if (
                typeof attributeCatalogue != "undefined" &&
                attributeCatalogue.length
            ) {
                FS.handleAttribute();
            }
        }
    };
    FS.quantityProductVariantMax = (res) => {
        let productVariantQuantiyMax = res.productVariant.quantity;
        $(".quantity-product-variant").attr("max", productVariantQuantiyMax);
    };
    FS.quantityInsockVariant = (res) => {
        let quantityInsockVariant = res.productVariant.quantity;
        if(quantityInsockVariant !== 0 || quantityInsockVariant !== null){

            $(".quantity-instock").html('( '+quantityInsockVariant+' '+' sản phẩm sẵn có '+')');
        }
    };
    // gọi hàm
    $(document).ready(function () {
        FS.selectVairantProduct();
        FS.activeVariantFirst();
    });
})(jQuery);
