(function ($) {
    "use strict";
    var FS = {};
    FS.animateMenuLink = () => {
        // // Check if there's a stored active menu item
        // const activeMenuItem = localStorage.getItem("activeMenuItem");
        // if (activeMenuItem) {
        //     $(`.menu-item-a[href="${activeMenuItem}"]`).addClass("active");
        // }

        $(document).on("click", ".menu-item-a", function (e) {
            // Không preventDefault() để cho phép chuyển trang
            let $this = $(this);
            let href = $this.attr("href");

            // Lưu href của menu item vừa click vào localStorage
            localStorage.setItem("activeMenuItem", href);

            // Xóa class active khỏi tất cả items
            $(".menu-item-a").removeClass("active");

            // Thêm active và animation cho item được click
            $this.addClass("active").animate(
                {
                    left: "60px",
                },
                300,
                function () {
                    // Sau khi animation hoàn thành thì chuyển trang
                    window.location.href = href;
                }
            );
        });
    };
    // menu aside acount
    FS.showSubMenu = () => {
        $(".nav-item-main").off('click').click(function (e) {
            $(document).on("click", ".menu-item-a", function (e) {
                // Không preventDefault() để cho phép chuyển trang
                let $this = $(this);
                let href = $this.attr("href");

                // Lưu href của menu item vừa click vào localStorage
                localStorage.setItem("activeMenuItem", href);

                // Xóa class active khỏi tất cả items
                $(".menu-item-a").removeClass("active");

                // Thêm active và animation cho item được click
                $this.addClass("active").animate(
                    {
                        left: "60px",
                    },
                    300,
                    function () {
                        // Sau khi animation hoàn thành thì chuyển trang
                        window.location.href = href;
                    }
                );
            });
        });
    };
    // menu aside acount
    FS.showSubMenu = () => {
        $(".nav-item-main").off('click').click(function (e) {
            let $submenu = $(this).next(".sub-menu-lv2");
            let $iconRight = $(this).find(".fa-chevron-right");
            let $iconDown = $(this).find(".fa-chevron-down");
            // khi click vào li thì active và xóa clas active cũ
            $(".nav-item-main").removeClass("active");
            $(this).addClass("active");
            if ($submenu.hasClass("d-none")) {
                $submenu
                    .hide()
                    .removeClass("d-none")
                    .addClass("active")
                    .slideDown(300);
                $iconRight.addClass("d-none");
                $iconDown.removeClass("d-none");
            } else {
                $submenu.slideUp(300, function () {
                    $(this).addClass("d-none").removeClass("active");
                });
                $iconRight.removeClass("d-none");
                $iconDown.addClass("d-none");
            }
        });
    };
    
    //aside acount
    FS.showSubMenuProfile = () => {
        $(".nav-item-profile").off('click').click(function (e) {
            let $submenu = $(this).next(".sub-menu-lv2");
            let $iconRight = $(this).find(".fa-chevron-right");
            let $iconDown = $(this).find(".fa-chevron-down");
            // khi click vào li thì active và xóa clas active cũ
            $(".nav-item-profile").removeClass("active");
            $(this).addClass("active");
            if ($submenu.hasClass("d-none")) {
                $submenu
                    .hide()
                    .removeClass("d-none")
                    .addClass("active")
                    .slideDown(300);
                $iconRight.addClass("d-none");
                $iconDown.removeClass("d-none");
            } else {
                $submenu.slideUp(300, function () {
                    $(this).addClass("d-none").removeClass("active");
                });
                $iconRight.removeClass("d-none");
                $iconDown.addClass("d-none");
            }
        });
    };

    FS.showSubMenuLv3 = () => {
        $(".sub-menu-li").off('click').click(function (e) {
            // e.preventDefault();

            let $submenuLv3 = $(this).find(".sub-menu-lv3");
            let $iconRightLv3 = $(this).find(".fa-chevron-right.lv3");
            let $iconDownLv3 = $(this).find(".fa-chevron-down.lv3");

            if ($submenuLv3.hasClass("d-none")) {
                $submenuLv3
                    .hide()
                    .removeClass("d-none")
                    .addClass("active")
                    .slideDown(300);
                $(this).addClass("active");
                $iconRightLv3.addClass("d-none");
                $iconDownLv3.removeClass("d-none");
            } else {
                $submenuLv3.slideUp(300, function () {
                    $(this).addClass("d-none").removeClass("active");
                });
                $(this).removeClass("active");
                $iconRightLv3.removeClass("d-none");
                $iconDownLv3.addClass("d-none");
            }
        });
    };
    // search key

    FS.setUpSelect2 = () => {
        $(".setUpSelect2").select2();
    };

    FS.clickShowPass = () => {
        $(document).on("click", ".icon-eye-password", function () {
            var inputTypePassword = $(this)
                .closest(".input-group")
                .find(".input-group-password");
            if (inputTypePassword.attr("type") == "password") {
                inputTypePassword.attr("type", "text");
            } else {
                inputTypePassword.attr("type", "password");
            }

            $(this).children().toggleClass("d-none");
        });
    };
    FS.activeColorChoosed = () => {
        $(document).on("click", ".color-item", function () {
            let _this = $(this);
            $(".color-item").removeClass("active");
            _this.toggleClass("active");
        });
    };
    FS.activeSizeChoosed = () => {
        $(document).on("click", ".size-item", function () {
            let _this = $(this);
            $(".size-item").removeClass("active");
            _this.toggleClass("active");
        });
    };
    FS.showhideAds = () => {
        $(document).on("click", ".delete-ads-aside", function () {
            console.log(2312);
            $(".image-ads-item").toggleClass("hidden-visibility");
        });
    };
    FS.boxQuantity = () => {
        $(".quantity-minus, .quantity-plus")
            .off("click")
            .click(function () {
                var $inputVisible = $(this).siblings("input.form-control");
                var $inputHidden = $(this).siblings('input[name="quantity"]');
                var $quantityCart = $(this).siblings(
                    'input[name="quantity-product-cart"]'
                );

                // lấy giá trị hiện tại và giới hạn min/max
                var value = parseInt($inputVisible.val(), 10);
                var max = parseInt($inputVisible.attr("max"), 10);
                var min = parseInt($inputVisible.attr("min"), 10) || 1;

                // Giảm giá trị nếu nhấn nút "minus" và lớn hơn min
                if ($(this).hasClass("quantity-minus") && value > min) {
                    value--;
                }
                // tăng giá trị nếu nhấn nút "plus" và nhỏ hơn max
                else if (
                    $(this).hasClass("quantity-plus") &&
                    (!max || value < max)
                ) {
                    value++;
                }

                $inputVisible.val(value);
                $inputHidden.val(value);
                $quantityCart.val(value);
            });
    };

    FS.backToTop = () => {
        window.addEventListener("scroll", () => {
            // bắt sự kiện cuộn mà hình theo chiều thẳng đứng hơn 300 ...
            if (window.scrollY > 300) {
                $(".back-to-top").removeClass("d-none");
            } else {
                $(".back-to-top").addClass("d-none");
            }
        });
        $(document).on("click", ".back-to-top", () => {
            // bắt sk click và scroll về top 0
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    };
    FS.chooseColorActive = () => {
        $(document).on("click", ".img-choose-color", function () {
            // chỉ một phàn tuer cùng class đc click đc active
            $(".img-choose-color").removeClass("active");
            $(this).addClass("active");
        });
    };
    FS.chooseMoneyActive = () => {
        $(document).on("click", ".box-item-choose-money", function () {
            // chỉ một phàn tuer cùng class đc click đc active
            $(".box-item-choose-money").removeClass("active");
            $(this).addClass("active");
        });
    };
    FS.nextTab = () => {
        $(".btnNext").click(function () {
            const nextTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .next("li")
                .find("button")[0];
            if (nextTabLinkEl) {
                const nextTab = new bootstrap.Tab(nextTabLinkEl);
                nextTab.show();
            }
        });

        $(".btnPrevious").click(function () {
            const prevTabLinkEl = $(".nav-tabs .active")
                .closest("li")
                .prev("li")
                .find("button")[0];
            if (prevTabLinkEl) {
                const prevTab = new bootstrap.Tab(prevTabLinkEl);
                prevTab.show();
            }
        });
    };
    FS.CheckBox = () => {
        // Xử lý khi checkbox "check-all" được click
        $("#check-all").on("change", function () {
            // Đặt thuộc tính 'checked' cho tất cả checkbox "checkbox-item" giống với trạng thái của checkbox "check-all"
            $(".checkbox-item").prop("checked", this.checked);
        });

        // Xử lý khi từng checkbox "checkbox-item" được click
        $(".checkbox-item").on("change", function () {
            // Kiểm tra nếu tất cả các checkbox "checkbox-item" đều được chọn
            if (
                $(".checkbox-item:checked").length ===
                $(".checkbox-item").length
            ) {
                // Đặt checkbox "check-all" thành checked
                $("#check-all").prop("checked", true);
            } else {
                // Nếu có ít nhất một checkbox "checkbox-item" không được chọn, bỏ chọn checkbox "check-all"
                $("#check-all").prop("checked", false);
            }
        });
    };

    $(document).ready(function () {
        FS.animateMenuLink();
        FS.showSubMenu();
        FS.showSubMenuProfile();
        FS.showSubMenuLv3();
        FS.setUpSelect2();
        FS.clickShowPass();
        FS.activeColorChoosed();
        FS.activeSizeChoosed();
        FS.boxQuantity();
        FS.showhideAds();
        FS.backToTop();
        FS.chooseColorActive();
        FS.chooseMoneyActive();
        FS.nextTab();
        FS.CheckBox();
    });
})(jQuery);
