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
                        type: "GET", // method
                        data: {
                            keyword: keyword,
                        },
                        success: function (res) {
                            var suggestionsList = $("#suggestions-list");
                            suggestionsList.empty();

                            // Duyệt qua từng key của object
                            Object.values(res).forEach(function (item) {

                                const listItem = `
                                    <li class="d-flex justify-content-between align-items-center text-muted py-2 search-recent-item">
                                        <a href="javascript:void(0)" class="content-search-mnpoly d-flex text-muted">
                                            <img src="${item.image}" alt="${item.name}" width="40" class="me-2 rounded-2">
                                            <span class=" text-truncate keyword-recent pt-2" style="max-width: 350px;">
                                            ${item.name}
                                            </span>
                                        </a>
                                        <i class="fa-solid fa-bookmark" data-bs-toggle="tooltip" data-bs-title="top tìm kiếm"></i>
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
    $(document).ready(function () {
        FS.suggestion();
    });
})(jQuery);
