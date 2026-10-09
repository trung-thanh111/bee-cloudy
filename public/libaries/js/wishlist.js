(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    // lay token tu the meta
    var _token = $('meta[name="csrf-token"]').attr("content");

    FS.toggleWishlist = () => {
        $(document).on("click", ".toggleWishlist", function (e) {
            e.preventDefault();

            let _this = $(this);
            let product_id = _this.find(".product_id_wishlist").text().trim();
            let product_variant_id = _this
                .find(".product_variant_id_wishlist")
                .text()
                .trim();
                
            let options = {
                product_variant_id: product_variant_id ?? null,
                product_id: product_variant_id ? null : product_id,
                _token: _token,
            };
            $.ajax({
                url: "/ajax/wishlist/toggle",
                type: "POST",
                data: options,
                dataType: "json",

                success: function (res) {
                    if (res.code == 10) {
                        if (res.redirect === "back") {
                            window.location.reload();
                        }
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

    $(document).ready(function () {
        FS.toggleWishlist();
    });
})(jQuery);
