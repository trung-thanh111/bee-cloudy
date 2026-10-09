(function ($) {
    "use strict";
    var FS = {}; // fashion

    function debounce(func, wait) {
        var timeout;
        return function () {
            var context = this,
                args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(function () {
                func.apply(context, args);
            }, wait);
        };
    }

    FS.suggestion = () => {
        $(document).on(
            "input",
            debounce(function () {
                let keyword = $("#keyword").val();
                if (keyword.length > 2) {
                    $.ajax({
                        url: "/ajax/search/suggestion",
                        type: "GET",
                        data: {
                            keyword: keyword,
                        },
                        success: function (res) {
                            var suggestionsList = $("#suggestions-list");
                            let productInWishlist = window.productInWishlist;
                            suggestionsList.empty();
                            if (res.length == 0) {
                                $(".list-search").addClass("hidden-visibility");
                            }
                            // Duyệt qua từng key của object
                            Object.values(res).forEach(function (item) {
                                const listItem = `
                                    <li class="d-flex justify-content-between align-items-center text-muted py-2 search-recent-item " >
                                        <span class="content-search-mnpoly d-flex text-muted">
                                            <img src="${item.image}" alt="${
                                    item.name
                                }" width="40" class="me-2 rounded-2">
                                            <span class=" text-truncate keyword-recent pt-2" style="max-width: 350px;">
                                            ${item.name}
                                            </span>
                                        </span>
                                        <span class="toggleWishlist" data-id="${
                                            item.id
                                        }">
                                        <i class="fa-${
                                            productInWishlist.includes(item.id)
                                                ? "solid"
                                                : "regular"
                                        } fa-bookmark" data-bs-toggle="tooltip" data-bs-title="${
                                    productInWishlist.includes(item.id)
                                        ? "Xóa khỏi yêu thích"
                                        : "Thêm vào yêu thích"
                                }"></i>
                                        </span>
                                        <span class="product_id_wishlist d-none">${
                                            item.id
                                        }</span>
                                    </li>
                                `;
                                suggestionsList.append(listItem);
                            });
                        },
                        error: function () {},
                    });
                }
            }, 300)
        );
    };
    FS.autoSubmitKeyword = () => {
        $(document).on(
            "click",
            ".content-search-mnpoly, .search-recent-item",
            function () {
                let keyword =
                    $(this).data("keyword") ||
                    $(this).find(".keyword-recent").text().trim();
                if (keyword) {
                    $("#keyword").val(keyword); // đưa từ khóa vào input
                    $(this).closest("form").submit(); // submit form
                }
            }
        );
    };

    FS.getKeywordClickKeywordRecent = () => {
        $(document).on("click", ".search-recent-item", function () {
            let keywordRecent = $.trim($(this).find(".keyword-recent").text());
            if (keywordRecent) {
                $(".search-header").val(keywordRecent); // Cập nhật input
            }
        });
    };

    FS.searchKeyUpShowPaper = (res) => {
        let isTyping = false;

        $(document).on("mouseenter", ".search-header, .wallpaper", function () {
            // kiểm tra xem input có giá trị hay không
            const hasValue = $(".search-header").val().length > 0;

            if (!isTyping) {
                $(".wallpaper")
                    .removeClass("d-none")
                    .css("top", hasValue ? "165px" : "100px");
            }
        });

        $(document).one("keyup", ".search-header", function () {
            isTyping = true;
            if ($(".search-header").val().length == 0) {
                $(".wallpaper").addClass("d-none");
            } else {
                $(".wallpaper").removeClass("d-none").css("top", "165px");
                $(".list-search").removeClass("d-none");
            }
            FS.searchKeyUpShowPaper();
        });

        $(document).on("mouseleave", ".search-header, .wallpaper", function () {
            isTyping = false;
            setTimeout(function () {
                if (
                    !$(".search-header").is(":hover") &&
                    !$(".wallpaper").is(":hover")
                ) {
                    $(".wallpaper").addClass("d-none");
                }
            }, 500);
        });
    };
    $(document).ready(function () {
        FS.suggestion();
        FS.searchKeyUpShowPaper();
        FS.autoSubmitKeyword();
        FS.getKeywordClickKeywordRecent();
    });
})(jQuery);
