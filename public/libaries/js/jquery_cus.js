(function(e){
    "use strict";
    var FS = {}

    FS.arrayIdBulkDel = () => {
        $(document).on('submit', '#bulk-delete-form', function (e) {
            e.preventDefault(); // Ngăn chặn form submit ngay lập tức
    
            const checkedBoxItem = $('.checkbox-item:checked').map(function () {
                return $(this).val();
            }).get();
    
            if (checkedBoxItem.length > 0) {
                // Đổ giá trị mảng ID vào input ẩn (sửa dùng id thay vì class)
                $('#checked_array_id').val(checkedBoxItem.join(','));
    
                // Gửi form sau khi giá trị đã được cập nhật
                this.submit();
            } else {
                alert('Vui lòng chọn ít nhất một bài viết để xóa.');
            }
        });
    };
    
    

    $(document).ready(function(){
        FS.arrayIdBulkDel()
    })

})(JQuery)