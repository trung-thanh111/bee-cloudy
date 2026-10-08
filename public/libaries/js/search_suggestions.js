(function ($) {
    "use strict";
    var FS = {}; // fashion 
    
    function debounce(func, wait) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function() {
                func.apply(context, args);
            }, wait);
        };
    }

    FS.suggestion = () => {
        $(document).on('input', debounce(function (){
            let keyword = $('#keyword').val();
            if(keyword.length > 2){
                $.ajax({
                    url: "/ajax/search/suggestion",
                    type: "GET", // method
                    data: {
                        keyword : keyword
                    },
                    success: function (res) {
                        console.log(res);
                    },
                    error: function () {
                        // flasher.error("Có lỗi xảy ra khi cập nhật giỏ hàng.");
                    },
                });
            }
        }, 300))
    }
    $(document).ready(function () {
        FS.suggestion();
    });
})(jQuery);
