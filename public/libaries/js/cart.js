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
            let product_variant_id =
                $(".product-variant-id").html() ??
                _this.attr("data-product-variant-id");
            let price =
                $(".product-variant-price").attr("data-price") ||
                _this.attr("data-product-variant-price");
            let quantity = $('input[name="quantity"]').val() ?? 1;
            if (typeof quantity == "undefined") {
                let quantity = 1;
            }

            let attribute_id = [];
            if ($(".attribute-value .choose-attribute").length > 0) {
                $(".attribute-value .choose-attribute").each(function (e) {
                    let _this = $(this);
                    if (_this.hasClass("active")) {
                        attribute_id.push(_this.attr("data-attributeId"));
                    }
                });
            } else {
                let attributeDefault = _this.attr("data-attributeId");
                if (attributeDefault) {
                    let attributes = attributeDefault.split(",");
                    let attributeIdArrayDF = attributes.map((item) =>
                        item.replace(/"/g, "")
                    );

                    attributeIdArrayDF.forEach((attr) =>
                        attribute_id.push(attr.trim())
                    );
                }
            }

            let options = {
                product_id: product_id,
                product_variant_id: product_variant_id,
                quantity: quantity,
                price: price,
                attribute_id: attribute_id,
                _token: _token,
            };
            if ($(this).hasClass("buyNow")) {
                e.preventDefault();
                $.ajax({
                    url: "/ajax/cart/addToCart",
                    type: "POST",
                    data: options,
                    dataType: "json",
                    success: function (res) {
                        if (res.code === 10) {
                            flasher.success(res.message);
                            let cartItems = res.cartItem;
                            if (cartItems && cartItems.length > 0) {
                                // lấy id vừa được chọn
                                let maxId = Math.max(
                                    ...cartItems.map((item) => item.id)
                                );
                                $.ajax({
                                    url: "/ajax/cart/clearSessionId", // xóa session
                                    type: "POST",
                                    data: {
                                        _token: _token,
                                    },
                                    success: function (res) {
                                        if (res.code === 10) {
                                            $.ajax({
                                                url: "/ajax/cart/sessionOrderByCartId",
                                                type: "POST",
                                                data: {
                                                    array_id: maxId,
                                                    _token: _token,
                                                },
                                                success: function (res) {
                                                    if (res.code === 10) {
                                                        window.location.href =
                                                            "/cart/index";
                                                    }
                                                },
                                                error: function (
                                                    xhr,
                                                    status,
                                                    error
                                                ) {
                                                    console.error(
                                                        "lỗi:",
                                                        xhr.responseText
                                                    );
                                                },
                                            });
                                        } else {
                                            flasher.error(res.message);
                                        }
                                    },
                                    error: function () {
                                        flasher.error(
                                            "Không thể làm mới session giỏ hàng."
                                        );
                                    },
                                });
                            }
                        } else {
                            flasher.error(res.message);
                        }
                    },
                    error: function () {
                        flasher.error("Có lỗi xảy ra khi thêm sản phẩm.");
                    },
                });
            } else {
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
            }
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
                        // flasher.success(response.message);
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
            let htmlCartNull = `<div class="no-product text-center p-3">
                            <a href="#">
                                <img src="/libaries/templates/bee-cloudy-user/libaries/images/image-add-to-cart.png"
                                    alt="" class="img-fluid object-fit-cover " width="200">
                                <div class="mt-1 text-white">
                                    <h6 class=" text-muted text-uppercase mb-2">Bạn chưa có sản phẩm nào!</h6>
                                    <a href="${"http://127.0.0.1:8000/shop"}" class="btn btn-success"><i
                                            class="mdi mdi-home me-1"></i>Xem sản phẩm</a>
                                </div>
                            </a>
                        </div>`;
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
                        if ($(".cart-item").length === 0) {
                            $(".bg-cart").hide();
                            $(".main-cart").html(htmlCartNull);
                        }
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
    // remake cart order
    FS.loadOrderByCartIdChecked = () => {
        const loadOrdersByIds = (ids) => {
            let orderNullHtml = `
                <tr>
                    <td colspan="3" class="text-center p-3">
                        <div class="img-null text-center">
                            <img src="/libaries/upload/images/order-null.png" alt="" class="" width="200" height="100">
                        </div>
                        <div class="mt-1">
                            <span class="fz-16 text-muted text-uppercase mb-2">Vui lòng chọn sản phẩm từ giỏ hàng</span>
                        </div>
                    </td>
                </tr>`;
            if (ids.length === 0) {
                $("#order_cart").html(orderNullHtml);
                return;
            }
            $.ajax({
                url: "/ajax/cart/LoadOrderByCartId",
                type: "GET",
                data: {
                    array_id: ids,
                    _token: _token,
                },
                success: function (res) {
                    if (res.code === 10) {
                        $("#order_cart").empty();
                        $("#order_cart").html(res.html);
                    }
                },
                error: function () {
                    flasher.error("Có lỗi xảy ra khi tải đơn hàng hàng.");
                },
            });
        };

        const getCheckedIds = () => {
            let arrayIdChecked = [];
            $(".checkbox-item:checked").each(function () {
                arrayIdChecked.push($(this).val());
            });
            return arrayIdChecked;
        };

        const saveCheckedIdsToSession = (ids) => {
            $.ajax({
                url: "/ajax/cart/sessionOrderByCartId",
                type: "POST",
                data: {
                    array_id: ids,
                    _token: _token,
                },
                success: function (res) {
                    if (res.code === 10) {
                    }
                },
                error: function (xhr, status, error) {
                    console.error("lỗi:", xhr.responseText);
                },
            });
        };

        const loadCheckedIdsFromSession = () => {
            let orderNullHtml = `
                <tr>
                    <td colspan="3" class="text-center p-3">
                        <div class="img-null text-center">
                            <img src="/libaries/upload/images/order-null.png" alt="" class="" width="200" height="100">
                        </div>
                        <div class="mt-1">
                            <span class="fz-16 text-muted text-uppercase mb-2">Vui lòng chọn sản phẩm từ giỏ hàng</span>
                        </div>
                    </td>
                </tr>`;
            $.ajax({
                url: "/ajax/cart/getOrderByCartId",
                type: "GET",
                success: function (res) {
                    if (res.code === 10) {
                        const ids = (res.array_id || []).map(String); // chuyển thành chuỗi để ss
                        if (ids.length === 0) {
                            $("#order_cart").html(orderNullHtml);
                            return;
                        }
                        $(".checkbox-item").each(function () {
                            const checkboxValue = String($(this).val()); // chuyển thành chuỗi để so sánh
                            if (ids.includes(checkboxValue)) {
                                $(this).prop("checked", true).trigger("change"); // dánh dấu checkbox và trigger dduu liệu
                            } else {
                                $(this).prop("checked", false);
                            }
                        });
                        const allChecked =
                            $(".checkbox-item:checked").length ===
                            $(".checkbox-item").length;
                        $("#check-all").prop("checked", allChecked); // checked checkbox all
                    }
                },
                error: function () {
                    flasher.error("Có lỗi khi lấy dữ liệu từ session.");
                },
            });
        };

        loadCheckedIdsFromSession();

        if ($("#check-all, .checkbox-item").length > 0) {
            $("#check-all, .checkbox-item").on("change", function () {
                const checkedIds = getCheckedIds();
                saveCheckedIdsToSession(checkedIds);
                loadOrdersByIds(checkedIds);
            });
        }
    };

    FS.updateQuantityOrder = () => {
        $("input[name=quantity-input]").each(function () {
            let quantity = $(this).val();
            let destroyId = $(this)
                .closest(".cart-item")
                .attr("data-destroy-id");
            $(
                '.order .cart-item[data-destroy-id="' +
                    destroyId +
                    '"] .orderQuantity'
            ).text("x" + quantity);
        });
    };

    FS.updateTotalPriceOrder = () => {
        $(".cart-item").each(function () {
            let price = $(this)
                .find(".orderPrice")
                .text()
                .replace(/[^0-9]/g, ""); // Loại bỏ ký tự không phải số
            let quantity = $(this)
                .find(".orderQuantity")
                .text()
                .replace("x", ""); // Loại bỏ ký tự 'x' và chuyển về số
            let totalPrice = price * quantity;

            $(this)
                .find(".totalPriceOrder")
                .text(new Intl.NumberFormat("vi-VN").format(totalPrice) + "đ");
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

        const modelE = document.getElementById("clearCartModal");
        if (modelE) {
            modal = new bootstrap.Modal(modelE);
        }

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
                            window.location.reload();
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

        // lấy sản phẩm đc checked
        $(".cart-item").each(function () {
            const isChecked = $(this).find(".checkbox-item").is(":checked");
            if (!isChecked) return;

            // Lấy giá trị của sản phẩm
            let price = parseFloat(
                $(this)
                    .find(".product-total-price")
                    .text()
                    .replace(/[^\d]/g, "")
            );
            console.log(price);

            if (!isNaN(price)) {
                total += price; // tính total
            }
        });
        // thành tiền
        $('tr:contains("Thành tiền:") td:last').text(
            total.toLocaleString("vi-VN") + "đ"
        );
        // .. giảm giá
        let discount = 0;
        const discountText = $("#discount-amount").text().trim();
        if (discountText !== "0đ") {
            discount = parseFloat(discountText.replace(/[^\d]/g, ""));
        }

        //vận chuyển
        let shippingFee = 0;
        const shippingText = $("#shopping_fee").text().trim();
        if (shippingText !== "Miễn phí") {
            shippingFee = 25000; 
        }

        const finalTotal = total - discount + shippingFee;
        $("#cart-total-price").text(finalTotal.toLocaleString("vi-VN") + "đ");
    };

    // gọi hàm
    $(document).ready(function () {
        FS.addToCart();
        FS.updateCart();
        FS.destroyCart();
        FS.clearCart();
        FS.loadOrderByCartIdChecked();
    });
})(jQuery);
