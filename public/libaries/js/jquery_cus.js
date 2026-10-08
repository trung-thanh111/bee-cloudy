(function (e) {
    "use strict";
    var FS = {};

    FS.arrayIdBulkDel = () => {
        $(document).on("submit", "#bulk-delete-form", function (e) {
            e.preventDefault(); // Ngăn chặn form submit ngay lập tức

            const checkedBoxItem = $(".checkbox-item:checked")
                .map(function () {
                    return $(this).val();
                })
                .get();

            if (checkedBoxItem.length > 0) {
                // Đổ giá trị mảng ID vào input ẩn (sửa dùng id thay vì class)
                $("#checked_array_id").val(checkedBoxItem.join(","));

                // Gửi form sau khi giá trị đã được cập nhật
                this.submit();
            } else {
                alert("Vui lòng chọn ít nhất một bài viết để xóa.");
            }
        });
    };

    //range picker
    FS.setUpRangePicker = () => {
        if ($(".rangepicker").length > 0) {
            $(".rangepicker").daterangepicker({
                locale: {
                    format: "YYYY-MM-DD",
                },
                ranges : {
                    'Hôm nay': [moment(), moment()],
                    'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                 }
            });
        }
    };

    $(document).ready(function () {
        FS.arrayIdBulkDel();
        FS.setUpRangePicker();
    });
})(jQuery);
