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

            FS.updateQuantityOrder();
            FS.updateTotalPriceOrder();
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
            let destroy_id = _this.attr("data-destroy-id");

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
                        // xóa sản phẩm ở phía giao diện cart và order
                        $(
                            '.cart-item[data-destroy-id="' + destroy_id + '"]'
                        ).remove();
                        // cập nhật giá
                        FS.updateTotalPrice();
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
<<<<<<< HEAD
    FS.clearCart = () => {
        let modal; 
=======

    FS.updateQuantityOrder = () => {
        $("input[name=quantity-input]").each(function () {
            let quantity = $(this).val();
            let destroyId = $(this).closest(".cart-item").attr("data-destroy-id");
            $('.order .cart-item[data-destroy-id="' + destroyId + '"] .orderQuantity').text('x' + quantity);
        });
    };
    
    FS.updateTotalPriceOrder = () => {
        $(".cart-item").each(function () {
            let price = $(this).find(".orderPrice").text().replace(/[^0-9]/g, ''); // Loại bỏ ký tự không phải số
            let quantity = $(this).find(".orderQuantity").text().replace('x', ''); // Loại bỏ ký tự 'x' và chuyển về số
            let totalPrice = price * quantity;
            
            $(this).find(".totalPriceOrder").text(new Intl.NumberFormat('vi-VN').format(totalPrice) + 'đ');
        });
    };
    
    FS.updateTotalPrice = () => {
        let total = 0;
        $(".orderPrice").each(function () {
            // Lấy giá trị của từng .orderPrice, loại bỏ ký tự "đ" và dấu phẩy
            let itemPrice = parseInt(
                $(this)
                    .text()
                    .replace(/[^0-9]/g, "")
            );
            total += itemPrice;
        });

        $("#cart-price").text(
            new Intl.NumberFormat("vi-VN").format(total) + "đ"
        );
    };
    FS.clearCart = () => {
        let modal;
>>>>>>> thanhtrung
        const modelE = document.getElementById("clearCartModal");
        if (modelE) {
            modal = new bootstrap.Modal(modelE);
        }
<<<<<<< HEAD
        
=======
>>>>>>> thanhtrung

        $(document).on("click", ".clearCart", function (e) {
            e.preventDefault();
            const cartId = $(this).data("cart-id");
            $("#confirmClearCart").data("cart-id", cartId);
            modal.show();
        });

        $("#cancelClearCart").on("click", () => modal.hide());

        $("#confirmClearCart").on("click", function () {
            const cartId = $(this).data("cart-id");
            modal.hide();
            $.ajax({
                url: "/ajax/cart/clearCart",
                type: "DELETE",
                data: {
                    cart_id: cartId,
                    _token: _token,
                },
                success: function (res) {
                    if (res.code == 10) {
                        $(".cart-item").empty();
                        setTimeout(function () {
                            window.location.href = res.redirect;
                        }, 1);
                        flasher.success(res.message);
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
