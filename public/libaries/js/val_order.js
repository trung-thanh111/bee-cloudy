(function ($) {
    "use strict";
    var FS = {}; // fashion
    var _token = $('meta[name="csrf-token"]').attr("content");

    FS.clickToUpdateNoteOrders = () => {
        $(document).on("click", ".edit-note", function () {
            // Kiểm tra nếu đã có input thì return
            if ($(".ajax-editnote").length > 0) {
                return;
            }

            let _this = $(this);
            let target = _this.attr("data-target");
            let contentNote = $(".content-note").text().trim();
            let html = FS.renderNoteInput(contentNote);
            let renderInput = $(".content-note").html(html);
        });
    };
    FS.renderNoteInput = (contentNote = "") => {
        return (
            '<input type="text" class="form-control ajax-editnote " id="inputNode" name="note" value="' +
            contentNote +
            '" data-original="' +
            contentNote +
            '">'
        );
    };

    FS.updateNote = () => {
        $(document).on("blur", ".ajax-editnote", function () {
            // Chỉ dùng blur
            let _this = $(this);
            let orderId = $(".orderId").val();
            let inputVal = _this.val();
            let originalVal = _this.attr("data-original"); // Thêm data-original

            // Ngay cả khi không thay đổi vẫn gửi ajax
            $.ajax({
                url: "/ajax/order/editNote",
                type: "POST",
                data: {
                    id: orderId,
                    note: inputVal,
                    _token: _token,
                },
                dataType: "json",
                success: function (res) {
                    if (res.code == 10) {
                        flasher.success(res.message);
                        _this.closest(".content-note").html(inputVal);
                    }
                },
                error: function (xhr) {
                    var response = JSON.parse(xhr.responseText);
                    flasher.error(response.message);
                },
            });
        });
    };

    FS.updateStatusOrder = (res) => {
        $(document).on("click", ".updateStatus", function () {
            let _this = $(this);
            let orderId = $(".orderId").val();
            let status = _this.attr("data-status");

            if (status === "canceled") {
                $("#confirmModal").modal("show");
                $(document).on("click", "#confirmCancel", function () {
                    FS.updateOrderStatusAjax(orderId, status);
                    $("#confirmModal").modal("hide");
                });
            }else {
                FS.updateOrderStatusAjax(orderId, status);
            }
        });
    };
    FS.updateOrderStatusAjax = (orderId, status) => {
        $.ajax({
            url: "/ajax/order/updateStatus",
            type: "POST",
            data: {
                id: orderId,
                status: status,
                _token: _token,
            },
            dataType: "json",
            success: function (res) {
                if (res.code == 10) {
                    if (res.redirect === "back") {
                        window.location.reload(); // reload lại trang
                    }
                }
            },
            error: function (xhr) {
                var response = JSON.parse(xhr.responseText);
            },
        });
    };
    FS.updatePaidAtOrder = (res) => {
        $(document).on("click", ".updatePaidAt", function () {
            let _this = $(this);
            let orderId = parseInt($(".orderId").val());
            let newDate = new Date().toISOString(); // lấy thời gian hiện tại 
            let paidAt = new Date(newDate).toLocaleString("en-CA", {
                year: "numeric",
                month: "2-digit",
                day: "2-digit",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false
            }).replace(",", ""); // dịnh dạng lại cho gióng csdl
            
            if(orderUpdatePaiAt.paid_at == null){
                FS.updateOrderPaidAtAjax(orderId, paidAt)
            }
        });
    };
    FS.updateOrderPaidAtAjax = (orderId, paidAt) => {
        $.ajax({
            url: "/ajax/order/updatePaidAt",
            type: "POST",
            data: {
                id: orderId,
                paid_at: paidAt,
                _token: _token,
            },
            dataType: "json",
            success: function (res) {
                if (res.code == 10) {
                    if (res.redirect === "back") {
                        window.location.reload(); // reload lại trang
                    }
                }
            },
        });
    };

    // gọi hàm
    $(document).ready(function () {
        FS.clickToUpdateNoteOrders();
        FS.updateNote();
        FS.updateStatusOrder();
        FS.updatePaidAtOrder();
    });
})(jQuery);
