(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    // lay token tu the meta
    var _token = $('meta[name="csrf-token"]').attr("content");

    FS.addToCart = () => {
        $(document).on("click", ".addToCart", function (e) {
            e.preventDefault();

            let _this = $(this);
            let product_id = _this.attr("data-id");
            let product_variant_id = $(".product-variant-id").html() ?? null;
            let price =
                $(".product-variant-price").attr("data-price") ||
                $(".product-variant-price").text().replace(/[^\d]/g, "");
            let quantity = $('input[name="quantity"]').val() ?? 1;
            if (typeof quantity == "undefined") {
                let quantity = 1;
            }

            let attribute_id = [];
            $(".attribute-value .choose-attribute").each(function (e) {
                // e.preventDefault();
                let _this = $(this);
                if (_this.hasClass("active")) {
                    attribute_id.push(_this.attr("data-attributeId"));
                }
            });

            let options = {
                product_id: product_id,
                product_variant_id: product_variant_id,
                quantity: quantity,
                price: price,
                attribute_id: attribute_id,
                _token: _token,
            };
            $.ajax({
                url: "/ajax/cart/addToCart",
                type: "POST",
                data: options,
                dataType: "json",

                success: function (res) {
                    if (res.code == 10) {
                        flasher.success(res.message);
                    }
                },
                error: function (xhr) {
                    var response = JSON.parse(xhr.responseText);
                    if (xhr.status == 401) {
                        flasher.error(response.message);
                        setTimeout(function () {
                            window.location.href = response.redirect;
                        }, 2000);
                    } else {
                        flasher.error(response.message);
                    }
                },
            });
        });
    };

    FS.updateCart = () => {
        $(document).on("click", ".updateCart", function () {
            let container = $(this).closest(".input-group");
            let quantityInput = container.find('input[name="quantity-input"]');
            let quantity = parseInt(quantityInput.val());

            quantityInput.val(quantity);

            let price = parseFloat(
                container.closest("tr").find(".product-price").data("price")
            );
            let newTotalPrice = (price * quantity).toFixed(0);

            container
                .closest("tr")
                .find(".product-total-price")
                .text(Number(newTotalPrice).toLocaleString("vi-VN") + "đ");

            // đổ vào đơn hàng

            //         let htmlOrderQuantity = `<strong class="text-info orderPrice">x${quantity}</strong>`;
            //         $(".orderQuantity").html(htmlOrderQuantity);

            //         let formattedPrice = Number(newTotalPrice).toLocaleString("vi-VN", {
            //             style: "currency",
            //             currency: "VND",
            //         });
            //         let htmlOrderPrice = `
            // <td class="text-end fz-14 fw-medium ">
            //     ${formattedPrice}
            // </td>`;
            //         $(".orderPrice").html(htmlOrderPrice);

            FS.updateCartTotal();

            $.ajax({
                url: "/ajax/cart/updateCart",
                type: "POST",
                data: {
                    product_id: container.find(".product-id").val(),
                    product_variant_id: container
                        .find(".product-variant-id")
                        .val(),
                    quantity: quantity,
                    _token: _token,
                },
                success: function (response) {
                    if (response.code == 10) {
                        flasher.success(response.message);
                    }
                },

                error: function () {
                    flasher.error("Có lỗi xảy ra khi cập nhật giỏ hàng.");
                },
            });
        });
    };
    FS.destroyCart = () => {
        $(document).on("click", ".destroyCart", function (e) {
            e.preventDefault();

            let _this = $(this);
            let product_id = _this.attr("data-id");
            let product_variant_id = _this.attr("data-variant-id");

            let datas = {
                product_id: product_id,
                product_variant_id: product_variant_id,
                _token: _token,
            };
            $.ajax({
                url: "/ajax/cart/destroyCart",
                type: "DELETE",
                data: datas,
                success: function (res) {
                    if (res.code == 10) {
                        _this.closest(".cart-item").remove();
                        flasher.success(res.message);
                    } else {
                        flasher.error("Có lỗi xảy ra khi cập nhật giỏ hàng.");
                    }
                },
                error: function () {
                    flasher.error("Có lỗi xảy ra khi cập nhật giỏ hàng."); 
                },
            });
        });
    };
    FS.clearCart = () => {
        const modal = new bootstrap.Modal(document.getElementById('clearCartModal'));
    
        $(document).on("click", ".clearCart", function (e) {
            e.preventDefault();
            const orderId = $(this).data('order-id');
            $('#confirmClearCart').data('order-id', orderId);
            modal.show();
        });
    
        $('#cancelClearCart').on('click', () => modal.hide());
    
        $('#confirmClearCart').on('click', function() {
            const orderId = $(this).data('order-id');
            modal.hide();
            $.ajax({
                url: "/ajax/cart/clearCart",
                type: "DELETE",
                data: {
                    order_id: orderId,
                    _token: _token 
                },
                success: function (res) {
                    if (res.code == 10) {
                        $('.cart-item').empty();
                        flasher.success(res.message);
                        setTimeout(function () {
                            window.location.href = res.redirect;
                        }, 500)
                    } 
                },
                error: function () {
                    flasher.error("Có lỗi xảy ra khi xóa giỏ hàng.");
                },
            });
        });
    };

    FS.updateCartTotal = () => {
        let total = 0;
        $(".product-total-price").each(function () {
            let price = parseFloat($(this).text().replace(/[^\d]/g, ""));
            if (!isNaN(price)) {
                total += price;
            }
        });

        $("#cart-total-price").text(total.toLocaleString("vi-VN") + "đ");
        $('tr:contains("Thành tiền:") td:last').text(
            total.toLocaleString("vi-VN") + "đ"
        );
    };
    // gọi hàm
    $(document).ready(function () {
        FS.addToCart();
        FS.updateCart();
        FS.destroyCart();
        FS.clearCart();
    });
})(jQuery);
