(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    // lay token tu the meta
    var _token = $('meta[name="csrf-token"]').attr('content');

    FS.addToCart = () => {
        $(document).on("click", ".addToCart", function (e) {
            e.preventDefault();
            
            let _this = $(this);
            let id = _this.attr("data-id");
            let price = $('.product-variant-price').attr('data-price') || $('.product-variant-price').text().replace(/[^\d]/g, '');
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
                id: id,
                quantity: quantity,
                price: price,
                attribute_id: attribute_id,
                _token: _token,
            }
            $.ajax({
                url: "/ajax/cart/addToCart",
                type: "POST",
                data: options,
                dataType: "json",

                success: function (res) {
                    // xử lý sau khi đã có dữ liệu trả về
                    console.log(res)
                },
            });
            
        });
    };
    // gọi hàm
    $(document).ready(function () {
        FS.addToCart();
    });
})(jQuery);
