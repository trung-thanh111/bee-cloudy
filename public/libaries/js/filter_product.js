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

    FS.autoSubmitFilter = () => {
        $(document).on('click', '.submitFilter .img-choose-color', function() {
            const colorValue = $(this).data('color') || '';
            $('.colorFilter').val(colorValue);
            
            setTimeout(() => {
                $(this).closest('form').submit();
            }, 0);
        });
    
        $(document).on('click', '.submitFilter .box-item-choose-money', function() {
            const priceValue = $(this).data('price') || '';
            $('.priceFilter').val(priceValue);
            
            setTimeout(() => {
                $(this).closest('form').submit();
            }, 0);
        });
    
        // vẫn giữ lại xử lý cho radio buttons (size) nếu có
        $('.submitFilter').on('change', function() {
            setTimeout(() => {
                $(this).closest('form').submit();
            }, 0);
        });
    }

    $(document).ready(function () {
        FS.valPriceFilter();
        FS.valColorFilter();
        FS.autoSubmitFilter();
    });
})(jQuery);
