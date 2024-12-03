(function ($) {
    "use strict";
    var FS = {};

    FS.setupCkEditor = () => {
        if ($(".ck-editor").length) {
            $(".ck-editor").each(function () {
                let editor = $(this);
                let elementId = editor.attr("id");
                let elementHeight = editor.attr("data-height");
                if (elementId) {
                    FS.ckeditor4(elementId, elementHeight);
                } else {
                    console.error(
                        "Element ID is required to initialize CKEditor."
                    );
                }
            });
        }
    };
    // hàm chọn nhiều ảnh trong ckeditor
    FS.multipleUploadImageCkeditor = () => {
        $(document).on("click", ".multipleUploadImageCkeditor", function (e) {
            // lưu các phần tử đc click
            let object = $(this);
            // lấy giá trị thuộc tinhd phần tử đc click và là id của trình soạn thảo ckeditor
            let target = object.attr("data-target");
            FS.browseServerCkeditor(object, "Images", target);
            // ngăn chặn hành động mặt đinh sự kiện click vào thẻ a
            e.preventDefault();
        });
    };
    // setup ckeditor
    FS.ckeditor4 = (elementId, elementHeight) => {
        if (typeof elementHeight == "undefined") {
            elementHeight = 250;
        }
        if (document.getElementById(elementId)) {
            CKEDITOR.replace(elementId, {
                height: elementHeight,
                removeButtons: "",
                entities: true,
                allowedContent: true,
                toolbarGroups: [
                    { name: "clipboard", group: ["clipboard", "undo"] },
                    {
                        name: "editing",
                        group: ["find", "selection", "spellchecker"],
                    },
                    { name: "links" },
                    { name: "insert" },
                    { name: "forms" },
                    { name: "tools" },
                    {
                        name: "document",
                        group: ["mode", "document", "doctools"],
                    },
                    { name: "colors" },
                    { name: "others" },
                    "/",
                    { name: "basicstyles", group: ["basicstyles", "cleanup"] },
                    {
                        name: "paragraph",
                        group: ["list", "indent", "blocks", "align", "bidi"],
                    },
                    { name: "styles" },
                ],
                filebrowserBrowseUrl:
                    "/libaries/plugins/ckfinder_2/ckfinder.html",
                filebrowserImageBrowseUrl:
                    "/libaries/plugins/ckfinder_2/ckfinder.html?type=Images",
                filebrowserFlashBrowseUrl:
                    "/libaries/plugins/ckfinder_2/ckfinder.html?type=Flash",
                filebrowserUploadUrl:
                    "/libaries/plugins/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Files",
                filebrowserImageUploadUrl:
                    "/libaries/plugins/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Images",
                filebrowserFlashUploadUrl:
                    "/libaries/plugins/ckfinder_2/core/connector/php/connector.php?command=QuickUpload&type=Flash",
            });
        } else {
            console.error("Element with ID " + elementId + " does not exist.");
        }
    };
    // upload hình ảnh từ input (1 ảnh)
    FS.uploadImageToinput = () => {
        $(".upload-image").click(function () {
            let input = $(this);
            let type = input.attr("data-type");
            FS.setupCkFinder2(input, type);
        });
    };
    // hiển thị 1 ảnh avata
    FS.uploadImageAvatar = () => {
        $(".image-target").click(function () {
            let input = $(this);
            let type = "Images";
            FS.browseServeAvatar(input, type);
        });
    };
    // mở ckfinder cho ng dùng chọn ảnh 
    FS.browseServeAvatar = function (object, type) {
        if (typeof type == "undefined") {
            // nếu k bắt đc type thì gán type
            type = "Images";
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data) {
            object.find("img").attr("src", fileUrl);
            object.siblings("input").val(fileUrl);
        };
        //bật popup 
        finder.popup();
    };

    FS.setupCkFinder2 = (object, type) => {
        if (typeof type == "undefined") {
            type = "Images";
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        // selectActionFunction sau khi mà chọn xong thì làm gì trong hàm
        finder.selectActionFunction = function (fileUrl, data) {
            // sau khi chọn thì đỗ dữ liệu vào obj và lấy ra url image
            object.val(fileUrl);
        };
        // lệnh mở cửa sổ của ck finder
        finder.popup();
    };
    //render ra các image vào ckeditor
    FS.browseServerCkeditor = (object, type, target) => {
        if (typeof type == "undefined") {
            type = "Images";
        }
        var finder = new CKFinder();
        finder.resourceType = type;
        // allFiles là tất cả file đc chọn
        finder.selectActionFunction = function (fileUrl, data, allFiles) {
            var html = "";
            for (var i = 0; i < allFiles.length; i++) {
                var image = allFiles[i].url;
                html += "<figure>";
                html +=
                    '<img src="' +
                    image +
                    '" alt="' +
                    image +
                    '" width="100%">';
                html += "<figcaption>Nhập Mô tả của hình ảnh</figcaption>";
                html += "</figure>";
            }
            if (CKEDITOR.instances[target]) {
                // push mảng ảnh vào ckeditor
                CKEDITOR.instances[target].insertHtml(html);
            } else {
                console.error(
                    'CKEditor instance "' + target + '" is not available.'
                );
            }
        };
        finder.popup();
    };

    // click to upload
    FS.uploadAlbum = function () {
        // bắt sự kiện click upload-picture
        $(document).on("click", ".upload-picture", function (e) {
            FS.browseServerAlbum();
            e.preventDefault();
        });
    };

    // render ra các image đc chọn 
    FS.browseServerAlbum = () => {
        var type = "Images";
        var finder = new CKFinder();
        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data, allFiles) {
            var html = "";
            for (var i = 0; i < allFiles.length; i++) {
                var image = allFiles[i].url;
                html += '<li class="album-item-seft list-unstyled m-2">';
                html += '<div class="thumb position-relative">';
                html += '<span class="span image img-scaledown">';
                html +=
                    '<img src="'+image+'" alt="'+image+'" class="object-fit-contain" width="130px" height="110px">';
                html += '<input type="hidden" name="album[]" value="'+image+'">';
                html +=
                    '<button class="delete-image position-absolute top-0 start-0"><i class="fa fa-trash icon-delete-albums"></i></button>';
                html += "</span>";
                html += "</div>";
                html += "</li>";
            }
            // ẩn nút di khi có
            $(".click-to-upload").addClass("d-none");
            // thêm phần tử vào cuối khi đc chọn = append
            $("#sortable").append(html);
            // hiển thị lại khi bị xóa hết
            $(".upload-list").removeClass("d-none");
        };
        finder.popup();
    };
    // delete các image in album 
    FS.deletePicture = () => {
        $(document).on("click", ".delete-image", function (e) {
            let _this = $(this);
            _this.parents(".album-item-seft").remove();
            if ($(".album-item-seft").length == 0) {
                $(".click-to-upload").removeClass("d-none");
                $(".upload-list").addClass("d-none");
            }
            e.preventDefault();
        });
    };

    $(document).ready(function () {
        FS.uploadImageToinput();
        FS.setupCkEditor();
        FS.uploadImageAvatar();
        FS.multipleUploadImageCkeditor();
        FS.uploadAlbum();
        FS.deletePicture();
    });
})(jQuery);
