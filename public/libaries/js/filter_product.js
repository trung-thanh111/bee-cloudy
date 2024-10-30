(function ($) {
    "use strict";
    var FS = {};
    FS.valColorFilter = () => {
        $(document).on("click", ".img-choose-color", function () {
            $(".img-choose-color").removeClass("active");
            $(this).addClass("active");
    
            $('input[name="color"]').val($(this).data("color"));
        });
    };
    
    // Lọc mức giá
    FS.valPriceFilter = () => {
        $(document).on("click", ".box-item-choose-money", function () {
            $(".box-item-choose-money").removeClass("active");
            $(this).addClass("active");
    
            $('input[name="price"]').val($(this).data("price"));
        });
    };

    $(document).ready(function () {
        FS.valPriceFilter();
        FS.valColorFilter();
    });
})(jQuery);
