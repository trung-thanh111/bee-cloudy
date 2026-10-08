(function ($) {
  "use strict";
  var FS = {};
  FS.animateMenuLink = () => {
    $(document).on("click", ".menu-item-a", function (e) {
      let _this = $(this);
      // Xóa class 'active' khỏi tất cả các item trước khi thêm vào item hiện tại
      $(".menu-item-a").removeClass("active");
      _this.addClass("active").animate(
        {
          left: "60px",
        },
        300
      );
      e.preventDefault();
    });
  };
  // menu aside acount
  FS.showSubMenu = () => {
    $(".nav-item-main").click(function (e) {
      e.preventDefault();

      let $submenu = $(this).next(".sub-menu-lv2");
      let $iconRight = $(this).find(".fa-chevron-right");
      let $iconDown = $(this).find(".fa-chevron-down");
      // khi click vào li thì active và xóa clas active cũ
      $(".nav-item-main").removeClass("active");
      $(this).addClass("active");
      if ($submenu.hasClass("d-none")) {
        $submenu.hide().removeClass("d-none").addClass("active").slideDown(300);
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
    $(".sub-menu-li").click(function (e) {
      e.preventDefault();

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
  FS.searchKeyUpShowPaper = () => {
    // Bắt sự kiện lần đầu nhập vào input -> one()
    $(document).one("keyup", ".search-header", function () {
      if (
        $(".search-header").val().length == 0 ||
        $(".search-header") === undefined
      ) {
        $(".wallpaper").addClass("d-none");
      } else {
        $(".wallpaper").removeClass("d-none");
      }
      //call back
      FS.searchKeyUpShowPaper();
    });
    $(document).on("mouseenter", ".search-header, .wallpaper", function () {
      $(".wallpaper").removeClass("d-none");
    });
    $(document).on("mouseleave", ".search-header, .wallpaper", function () {
      setTimeout(function () {
        if (
          !$(".search-header").is(":hover") &&
          !$(".wallpaper").is(":hover")
        ) {
          $(".wallpaper").addClass("d-none");
        }
      }, 500);
    });
    $(document).on("focus", ".search-header", function () {
      if ($(".search-header").val().length > 0 || $(".wallpaper").length) {
        $(".wallpaper").removeClass("d-none");
      }
    });
  };
  FS.getKeywordClickKeywordRecent = () => {
    $(document).on("click", ".search-recent-item", function () {
      let _this = $(this);
      //sử dụng this để lấy ra 1 phần tử đc click
      let keywordRecent = $.trim(_this.find(".keyword-recent").text());
      if($(".search-header").val() > 0){
        $(".search-header").val() = " "
      }else{
        $(".search-header").val(keywordRecent)
      }
    });
  };

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
    $(".quantity-minus, .quantity-plus").click(function () {
      var $inputVisible = $(this).siblings("input.form-control");
      var $inputHidden = $(this).siblings('input[type="hidden"]');

      var value = parseInt($inputVisible.val(), 10);
      if ($(this).hasClass("quantity-minus") && value > 1) {
        value--;
      } else if ($(this).hasClass("quantity-plus")) {
        value++;
      }

      $inputVisible.val(value);
      $inputHidden.val(value);
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

  // FS.chooseOneSize = () => {
  //   $(document).on("click", ".choose-size-item input", function () {

  //     if ($(this).is(":checked")) {
  //       console.log("Selected size:", $(this).next('p').text());
  //     }
  //   });
  // }

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
    $(document).on('click', '.next-tab', function() {
        var nextTab = $(this).data('nexttab');
        $('#' + nextTab).tab('show')
    });
}
FS.CheckBox = () => {
    // Xử lý khi checkbox "check-all" được click
    $('#check-all').on('change', function () {
        // Đặt thuộc tính 'checked' cho tất cả checkbox "checkbox-item" giống với trạng thái của checkbox "check-all"
        $('.checkbox-item').prop('checked', this.checked);
    });
  
    // Xử lý khi từng checkbox "checkbox-item" được click
    $('.checkbox-item').on('change', function () {
        // Kiểm tra nếu tất cả các checkbox "checkbox-item" đều được chọn
        if ($('.checkbox-item:checked').length === $('.checkbox-item').length) {
            // Đặt checkbox "check-all" thành checked
            $('#check-all').prop('checked', true);
        } else {
            // Nếu có ít nhất một checkbox "checkbox-item" không được chọn, bỏ chọn checkbox "check-all"
            $('#check-all').prop('checked', false);
        }
    });

}


  $(document).ready(function () {
    FS.animateMenuLink();
    FS.showSubMenu();
    FS.showSubMenuLv3();
    FS.searchKeyUpShowPaper();
    FS.getKeywordClickKeywordRecent();
    FS.setUpSelect2();
    FS.clickShowPass();
    FS.activeColorChoosed();
    FS.activeSizeChoosed();
    FS.boxQuantity();
    FS.showhideAds();
    FS.backToTop();
    FS.chooseColorActive();
    FS.chooseMoneyActive();
    FS.nextTab()
    FS.CheckBox()
  });
})(jQuery);
