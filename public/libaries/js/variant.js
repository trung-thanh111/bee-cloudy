(function ($) {
    "use strict";
    var FS = {}; // khai báo một obj rỗng
    // hiển thị popup cho thêm sản phẩm nhiều phiên bản
    FS.setUpProductVariant = () => {
        if ($(".turnOnVariant").length) {
            $(document).on("click", ".turnOnVariant", function () {
                let _this = $(this);
                let price = $('input[name="price"]').val();
                let sku = $('input[name="sku"]').val()
                if(price == '' || sku == '') {
                    alert('Vui lòng nhập giá và mã sản phẩm')
                    return false
                } 
                if (_this.siblings("input:checked").length == 0) {
                    $(".variant-wrapper").removeClass("d-none");
                } else {
                    $(".variant-wrapper").addClass("d-none");
                }
            });
        }
    };
    // bắt sự kiện click nút add để render ra variant-body
    FS.addVariant = () => {
        // điều kiện kiểm tra xem có add-variant không
        if ($(".add-variant").length) {
            $(document).on("click", ".add-variant", function () {
                let html = FS.renderVariantItem(attributeCatalogue);
                $(".variant-body").append(html);
    
                // Xóa class d-none khỏi phần tử product-variant khi thêm variant
                // $('.product-variant').removeClass('d-none');
                
                // nếu khi mà ng dùng click vào nhóm thuộc tính mới sẽ xóa thead và tbody để render lại 
                $('.variantTable thead').html('');
                $('.variantTable tbody').html('');
    
                FS.checkMaxAttributeGroup(attributeCatalogue);
                FS.disabledAttributeCatalogueChoose();
            });
        }
    };

    // render variant khi click vào nút add-variant
    // tham số dữ liệu json attributeCatalogue đổ ra select với id, name
    FS.renderVariantItem = (attributeCatalogue) => {
        let html = "";
        html = html + '<div class="row variant-item pt-3 pb-3">';
        html = html + '<div class="col-lg-3">';
        html = html + '<div class="attribute-catalogue">';
        html =
            html + '<select name="attributeCatalogue[]" id="" class="choose-attribute niceSelect">';
        html = html + '<option value="">Nhóm thuộc tính</option>';
        for (let i = 0; i < attributeCatalogue.length; i++) {
            html =
                html +
                '<option value="' +
                attributeCatalogue[i].id +
                '">' +
                attributeCatalogue[i].name +
                "</option>";
        }
        html = html + "</select>";
        html = html + "</div>";
        html = html + "</div>";
        html = html + '<div class="col-lg-8">';
        html =
            html +
            '<input type="text" name="" disabled class="fake-variant form-control">';
        html = html + "</div>";
        html = html + '<div class="col-lg-1">';
        html =
            html +
            '<button type="button" class="remove-attribute btn btn-danger"><svg data-icon="TrashSolidLarge" aria-hidden="true" focusable="false" width="15" height="16" viewBox="0 0 15 16" class="bem-Svg" style="display: block;"><path fill="currentColor" d="M2 14a1 1 0 001 1h9a1 1 0 001-1V6H2v8zM13 2h-3a1 1 0 01-1-1H6a1 1 0 01-1 1H1v2h13V2h-1z"></path></svg></button>';
        html = html + "</div>";
        html = html + "</div>";

        return html;
    };

    FS.niceSelect = () => {
        $(".niceSelect").niceSelect();
    };

    FS.destroyNiceSelect = () => {
        if ($(".niceSelect").length) {
            $(".niceSelect").niceSelect("destroy");
        }
    };

    // hàm k cho chọn nhiều loại thuộc tính trùng nhau
    FS.disabledAttributeCatalogueChoose = () => {
        let id = [];
        $(".choose-attribute").each(function () {
            let _this = $(this);
            let selected = _this.find("option:selected").val();
            if (selected != 0) {
                id.push(selected);
            }
        });

        $(".choose-attribute").find("option").removeAttr("disabled");
        for (let i = 0; i < id.length; i++) {
            $(".choose-attribute")
                .find("option[value=" + id[i] + "]")
                .prop("disabled", true);
        }
        FS.destroyNiceSelect();
        FS.niceSelect();
        $(".choose-attribute").find("option:selected").removeAttr("disabled");
    };

    // hàm kiểm tra nhóm thuộc tính
    FS.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $(".variant-item").length;
        if (variantItem >= attributeCatalogue.length) {
            // nếu mad variant_item >= số lượng attributeCatalogue thì xóa buton add-variant
            $(".add-variant").remove();
        } else {
            //thêm lại button cho ng dùng add-variant
            $(".variant-foot").html(
                '<button type="button" class="add-variant">Thêm phiên bản mới</button>'
            );
        }
    };
    FS.removeAttribute = () => {
        // bắt sk click nút remove-attribute
        $(document).on("click", ".remove-attribute", function () {
            let _this = $(this); // khia báo đối tượng
            _this.parents(".variant-item").remove(); // thực hiện xóa
            // tính lại và bật số lượng thuộc tính và bât lại nút
            FS.checkMaxAttributeGroup(attributeCatalogue);
            // xóa xong gọi lại hàm này cho render lại các thuộc tính còn k bị xóa
            FS.createVariant()
        });
    };

    FS.select2Variant = (attributeCatalogueId) => {
        let html =
            '<select class="selectVariant variant-' +
            attributeCatalogueId +
            ' form-control" name="attribute[' +
            attributeCatalogueId +
            '][]" multiple data-catid="' +
            attributeCatalogueId +
            '"></select>';
        return html;
    };

    FS.chooseVariantGroup = () => {
        $(document).on("change", ".choose-attribute", function () {
            let _this = $(this);
            let attributeCatalogueId = _this.val();
            if (attributeCatalogueId != 0) {
                _this
                    .parents(".col-lg-3")
                    .siblings(".col-lg-8")
                    .html(FS.select2Variant(attributeCatalogueId));
                $(".selectVariant").each(function (key, index) {
                    FS.getSelect2($(this));
                });
            } else {
                _this
                    .parents(".col-lg-3")
                    .siblings(".col-lg-8")
                    .html(
                        '<input type="text" name="attribute['+attributeCatalogueId+'][]" disabled="" class="fake-variant form-control">'
                    );
            }
            FS.disabledAttributeCatalogueChoose();
        });
    };
    // lấy dữ liệu vào select để tìm kiếm bằng select ajax
    FS.getSelect2 = (object) => {
        let option = {
            // bắt lấy data-cataid ở selectVariant
            attributeCatalogueId: object.attr("data-catid"),
        };
        $(object).select2({
            minimumInputLength: 2, // tối thiểu 2 ký tự
            placeholder: "Nhập tối thiểu 2 kí tự để tìm kiếm",
            ajax: {
                url: "/ajax/attribute/getAttribute", // chú ý kỹ đường dẫn nên để tuyệt đối
                type: "GET",
                dataType: "json",
                deley: 250, // 250 miliseconds
                data: function (params) {
                    return {
                        // params là những gì mình nhập vào
                        search: params.term,
                        option: option,
                    };
                },
                // thành công trả về kết quả là data.items
                processResults: function (data) {
                    return {
                        results: data.items,
                    };
                },
                cache: true,
            },
        });
    };

    FS.createProductVariant = () => {
        $(document).on("change", ".selectVariant", function () {
            let _this = $(this);
            FS.createVariant();
        });
    };

    FS.createVariant = () => {
        let attributes = []; // lưu tên
        let variants = []; //lưu id 
        let attributeTitle = []; // lưu đầu mục 
        $(".variant-item").each(function () {
            let _this = $(this);
            let attr = [];
            let attrVariant = [];
            let attrinbuteCatalogueId = _this.find(".choose-attribute").val();
            // lấy ra text của option
            let optionText = _this
                .find(".choose-attribute option:selected")
                .text();
            // lấy dữ liệu từ select2 đc chọn  -> slect2('data')
            let attribute = $(".variant-" + attrinbuteCatalogueId).select2(
                "data"
            );

            // lập qua dữ liệu cần lấy và push vào mảng attr
            for (let i = 0; i < attribute.length; i++) {
                let item = {};
                let itemVariant = {};
                item[optionText] = attribute[i].text;
                itemVariant[attrinbuteCatalogueId] = attribute[i].id 
                attr.push(item); // push text vào mảng attr
                attrVariant.push(itemVariant); // push ud vào mảng attr
            }
            // lấy ra title của các thuộc tính push nó vào mảng
            attributeTitle.push(optionText);
            // lấy ra các thuộc tính push nó vào mảng
            attributes.push(attr);
            //lấy ra id danh mục của thuộc tính và id thuôc tính
            variants.push(attrVariant);
        });
        // tạo ra tất cả phiên bản từ việc chọn dữ liệu trong select
        /* kiểu như này 
            {Màu sắc: 'Vàng', Kích Thước: '128GB', Vật liệu: 'Titan'}
            {Màu sắc: 'Đỏ', Kích Thước: '128GB', Vật liệu: 'Titan'}
        */
        attributes = attributes.reduce((a, b) =>
            a.flatMap((d) => b.map((e) => ({ ...d, ...e })))
        );
        // tạo ra các phiên bản ghép id variant lại với nhau 
        variants = variants.reduce((a, b) =>
            a.flatMap((d) => b.map((e) => ({ ...d, ...e })))
        );

        
        // gọi hàm tách việc render ra, k mất dữ liệu khi thêm mới thuộc tính or loại 
        FS.createTableheader(attributeTitle)
        // reder nguyên bảng -> dẫn dến mất dữ liệu các variant khi thêm mới thuộc tính  
        // let html = FS.renderTableHtml(attributes, attributeTitle, variants);
        // $("table.variantTable").html(html);
        
        let trClass = []
        attributes.forEach((item, index) => {
            let $row = FS.createVairantRow(item, variants[index]);
            let classModified = 'tr-variant-'+Object.values(variants[index]).join(', ').replace(/, /g, '-')
            trClass.push(classModified)
            // kiểm tra nếu k có class thì mới apend row -> tránh trung row đã có 
            if(!$('table.variantTable tbody tr').hasClass(classModified)){
                $('table.variantTable tbody').append($row);
            }
        });
        $('table.variantTable tbody tr').each(function (){
            const $row = $(this)
            const rowClasses = $row.attr('class')
            if(rowClasses){
                const rowClassArray = rowClasses.split(' ')
                let shouldRemove = false
                rowClassArray.forEach(rowClass => {
                    if(rowClass == 'variant-row'){
                        return
                    }else if(!trClass.includes(rowClass)){
                        shouldRemove = true
                    }
                }) 
                if(shouldRemove){
                    $row.remove()
                }
            }
        })
    };
    // tách phân thead và tbody 
    FS.createTableheader = (atrtibuteTitle) =>{
        let tHead = $('table.variantTable thead') 
        let row = $('<tr>')
        row.append($('<td>').text('Hình ảnh'))
        for(let i = 0; i < atrtibuteTitle.length; i++){
            row.append($('<td>').text(atrtibuteTitle[i]))
        }
        row.append($('<td>').text('Số lượng'))
        row.append($('<td>').text('Giá'))
        row.append($('<td>').text('SKU'))
        tHead.html(row)
        return tHead
    }
    FS.createVairantRow = (attributeItem, variantItem) => {

        let attributeString = Object.values(attributeItem).join(', ')
        let attributeId = Object.values(variantItem).join(', ')
        // chuyyển tất cả dấu , trong chuỗi attributeId thành -
        let classModified = attributeId.replace(/, /g, '-')

        let $row = $('<tr>').addClass('variant-row tr-variant-'+classModified)
        let $td
        $td = $('<td>').css({"width" : "120px", "text-align": "start"}).append(
            $('<span>').addClass('image img-cover object-fit-cover').append(
                $('<img>').addClass('w-100').attr('src', '/libaries/upload/images/img-notfound.png').addClass('imageSrc')
            )
        )
        $row.append($td)
        // mảng giá trị thuộc tính đc chọn 
        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value)
            $row.append($td)
        })
        $td = $('<td>').addClass('d-none td-variant')
        let mainPrice = $('input[name=price]').val()
        let mainSku = $('input[name=sku]').val()
        let inputHidenFields = [
            {name: 'variant[quantity][]', class: 'variant_quantity'},
            {name: 'variant[sku][]', class: 'variant_sku', value: mainSku+'-'+classModified},
            {name: 'variant[price][]', class: 'variant_price', value: mainPrice},
            {name: 'variant[file_name][]', class: 'variant_filename'},
            {name: 'variant[file_url][]', class: 'variant_fileurl'},
            {name: 'variant[album][]', class: 'variant_album'},
            {name: 'productVariant[name][]', value: attributeString},
            {name: 'productVariant[id][]', value: attributeId},
        ]
        $.each(inputHidenFields, function (_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class)
            if(field.value){
                $input.val(field.value)
            }
            $td.append($input)
        })

        $row.append($('<td>').addClass('td-quantity').text(1))
            .append($('<td>').addClass('td-price').text(mainPrice))
            .append($('<td>').addClass('td-sku').text(mainSku+'-'+classModified))
            .append($td)
            return $row
    }
    

    
    // 1. bắt sự kiện click nut upload album variant
    FS.variantAlbum = () => {
        $(document).on("click", ".upload-variant-picture", function (e) {
            FS.browseVariantServerAlbum();
            e.preventDefault();
        });
    };
    // 2. mở popup ck finder và hiển thị ảnh đc chọn
    FS.browseVariantServerAlbum = () => {
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
                    '<img src="' +
                    image +
                    '" alt="' +
                    image +
                    '" class="object-fit-contain" width="130px" height="110px">';
                html +=
                    '<input type="hidden" name="variantAlbum[]" value="' +
                    image +
                    '">';
                html +=
                    '<button class="delete-variant-image position-absolute top-0 start-0"><i class="fa-solid fa-trash"></i></button>';
                html += "</div>";
                html += "</li>";
            }
            $(".click-to-upload-variant").addClass("d-none");
            $("#sortable2").append(html);
            $(".upload-variant-list").removeClass("d-none");
        };
        finder.popup();
    };
    // 2. mở popup ck finder và hiển thị ảnh đc chọn
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
                    '<img src="' +
                    image +
                    '" alt="' +
                    image +
                    '" class="object-fit-contain" width="130px" height="110px">';
                html +=
                    '<input type="hidden" name="album[]" value="' +
                    image +
                    '">';
                html +=
                    '<button class="delete-variant-image position-absolute top-0 start-0"><i class="fa-solid fa-trash"></i></button>';
                html += "</div>";
                html += "</li>";
            }
            $(".click-to-upload-album").addClass("d-none");
            $("#sortable3").append(html);
            $(".upload-album").removeClass("d-none");
        };
        finder.popup();
    };
    FS.deleteVariantPicture = () => {
        $(document).on("click", ".delete-variant-image", function (e) {
            let _this = $(this);
            _this.parents(".album-item-seft").remove();
            if ($(".album-item-seft").length == 0) {
                $(".click-to-upload-variant").removeClass("d-none");
                $(".upload-variant-list").addClass("d-none");
            }
            e.preventDefault();
        });
    };

    // cho phép chỉnh sửa
    // FS.switchChange = () => {
    //     $(document).on("change", ".js-switch", function () {
    //         let _this = $(this);
    //         let checked = _this.prop("checked");
    //         if (checked == true) {
    //             // tìm kiếm phần tử cha có col-lg-2 và ptu anh chị có col-lg-10 và tìm trong col-log-10 có class
    //             // disable thì xóa thuộc tính attribute disabled của phần tử đang thực hiện _this
    //             _this
    //                 .parents(".col-lg-2")
    //                 .siblings(".col-lg-10")
    //                 .find(".disabled")
    //                 .removeAttr("disabled");
    //         } else {
    //             // nếu false thì thêm thuộc tính disabled
    //             _this
    //                 .parents(".col-lg-2")
    //                 .siblings(".col-lg-10")
    //                 .find(".disabled")
    //                 .attr("disabled", true);
    //         }
    //     });
    // };
    // switchery

    // FS.switchery = () => {
    //     $(".js-switch").each(function (html) {
    //         var switchery = new Switchery(this, { color: "#1AB394" });
    //     });
    // };
    // khi click vào tr thì cho update các field của sản phẩm
    FS.updateVariant = () => {
        $(document).on("click", ".variant-row", function () {
            let _this = $(this);
            let variantData = {}
            _this.find(".td-variant input[type=text][class^='variant_']").each(function (){
                let className = $(this).attr("class")
                variantData[className] = $(this).val()
            })
            // gọi updateVariantHtml trả về nội dung
            let updateVariantBox = FS.updateVariantHtml(variantData);
            // chèn nội dung vào sau đối tượng đc chọn
            if ($(".updateVariantTr").length == 0) {
                _this.after(updateVariantBox);
            }
        });
    };

    FS.variantAlbumList = (album) => {
        let html = "";
        if(album.length && album[0] !== ''){
            for(let i=0; i<album.length;i++){
                html +='<li class="album-item-seft list-unstyled m-2">'
                    html +='<div class="thumb position-relative">'
                        html +='<span class="span image img-scaledown">'
                            html +='<img src="'+album[i]+'" alt="'+album[i]+'" class="object-fit-contain" width="130px" height="110px">'
                            html +='<input type="hidden" name="variantAlbum[]" value="'+album[i]+'">'
                            html +='<button class="delete-variant-image position-absolute top-0 start-0">'
                                html +='<i class="fa-solid fa-trash"></i>'
                            html +='</button>'
                        html +='</span>'
                    html +='</div>'
                html +='</li>'
            }
        }
        return html
    }
    // nội dung html edit pb sản phẩm
    FS.updateVariantHtml = (variantData) => {
    
        
        // chuyển chuổi thành mảng -> load ra
        let variantAlbum = variantData.variant_album.split(',');
        let vatiantAlbumItem = FS.variantAlbumList(variantAlbum)
        let html = "";
        html += ' <tr class="updateVariantTr">';
        html += ' <td colspan="6" class="px-0">';
        html += ' <div class="updateVariant card">';
        html += ' <div class="card-header">';
        html +=
            ' <div class="d-flex align-items-center justify-content-between">';
        html += " <div>";
        html += " <h5>Cập nhật thông tin phiên bản</h5>";
        html += " </div>";
        html += ' <div class="btn-group">';
        html += ' <div class="d-flex justify-content-center">';
        html +=
            ' <button type="button" class="cancelUpdate btn btn-soft-danger me-3">Hủy bỏ</button>';
        html += ' <button type="button" class="saveUpdate btn btn-success">Lưu';
        html += " </button>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += ' <div class="card-body text-start">';
        html += ' <div class="card">';
        html += ' <div class="card-header">';
        html +=
            ' <div class="d-flex justify-content-between align-items-center">';
        html += " <h5>Albums ảnh</h5>";
        html +=
            ' <div class="upload-album"><a href="#" class="upload-variant-picture">Chọn hình</a></div>';
        html += " </div>";
        html += " </div>";
        html += ' <div class="card-body">';
        html += ' <div class="row">';
        html += ' <div class="col-lg-12">';
        html += ' <div class="click-to-upload-variant text-center '+( (variantAlbum.length > 0 && variantAlbum[0] != '') ? 'd-none' : '')+'">';
        html += ' <div class="icon">';
        html += ' <a type="button" class="upload-variant-picture">';
        html +=
            ' <img src="/libaries/upload/images/img-notfound.png" alt="" class="render-image object-fit-cover rounded-1 mb-2 position-relative " width="96" height="96">';
        html += " </a>";
        html += " </div>";
        html += ' <div class="small-text">';
        html +=
            " <span>Sử dụng nút chọn hình hoặc click vào đây để thêm hình ảnh.</span>";
        html += " </div>";
        html += " </div>";
        html += ' <div class="upload-variant-list '+( (variantAlbum.length == 0 && variantAlbum != '') ? 'd-none' : '' )+'">';
        html += ' <div class="row">';
        html +=
            ' <ul id="sortable2" class="clearfix data-album sortui ui-sortable d-lg-flex justify-content-start flex-wrap">'+vatiantAlbumItem+' </ul>';
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += ' <div class="row mt-3 ">';
        html += ' <div class="col-lg-2 pt-4 ">';
        html += ' <label for="" class="form-label me-1">Tồn kho</label>';
        html += " </div>";
        html += ' <div class="col-lg-10">';
        html += ' <div class="row">';
        html += ' <div class="col-lg-4">';
        html += ' <label for="" class="control-label ">Số lượng</label>';
        html +=
            ' <input type="text" class="form-control int" id="variantQuantity" required name="variant_quantity" value="'+ (variantData.variant_quantity ? variantData.variant_quantity : 1) +'">';
        html += " </div>";
        html += ' <div class="col-lg-4">';
        html += ' <label for="" class="control-label">SKU</label>';
        html +=
            ' <input type="text" class="form-control" name="variant_sku" value="'+variantData.variant_sku+'">';
        html += " </div>";
        html += ' <div class="col-lg-4">';
        html += ' <label for="" class="control-label">Giá</label>';
        html +=
            ' <input type="text" class="form-control" name="variant_price" value="'+variantData.variant_price+'">';
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += ' <div class="row mt-3">';
        html += ' <div class="col-lg-2 pt-4">';
        html += ' <label for="" class="form-label me-2">QL File </label>';
        html += " </div>";
        html += ' <div class="col-lg-10">';
        html += ' <div class="row">';
        html += ' <div class="col-lg-6">';
        html += ' <label for="" class="control-label">Tên file</label>';
        html +=
            ' <input type="text" class="form-control" name="variant_file_name"  value="'+variantData.variant_filename+'">';
        html += " </div>";
        html += ' <div class="col-lg-6">';
        html += ' <label for="" class="control-label">Đường dẫn</label>';
        html +=
            ' <input type="text" class="form-control" name="variant_file_url" value="'+variantData.variant_fileurl+'">';
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </div>";
        html += " </td>";
        html += " </tr>";
        return html;
    };

    // hàm hủy kh update các field của phiên bản
    FS.cancelVariantUpdate = () => {
        $(document).on("click", ".cancelUpdate", function () {
            FS.closeUpdateVariantBox()
        });
    };
    FS.saveVariantUpdate = () => {
        $(document).on("click", ".saveUpdate", function () {
            let variant = {
                // lấy giá trị của từng input tương ứng
                quantity: $("input[name=variant_quantity]").val(),
                sku: $("input[name=variant_sku]").val(),
                price: $("input[name=variant_price]").val(),
                filename: $("input[name=variant_file_name]").val(),
                fileurl: $("input[name=variant_file_url]").val(),
                album: $("input[name='variantAlbum[]']")
                    .map(function () {
                        return $(this).val();
                    })
                    .get(),
                };
                 
                $.each(variant, function (index, value) {
                    $(".updateVariantTr")
                        .prev()
                        .find(".variant_" + index)
                        .val(value);
                   
                });
                FS.showProductVariant(variant)
            FS.closeUpdateVariantBox()

        });
    };

    FS.showProductVariant = (variant) =>{
        let option = {
            quantity: variant.quantity,
            price: variant.price,
            sku: variant.sku,
        };
        $.each(option, function (index, value) {
            $(".updateVariantTr")
                .prev()
                .find(".td-" + index)
                .html(value); // td k phải là input nên phải .html
        });
        $(".updateVariantTr")
            .prev()
            .find(".imageSrc")
            .attr("src", variant.album[0]);
    }
    FS.closeUpdateVariantBox = () => {
        $('.updateVariantTr').remove()
    }

    // sử dụng callback để gọi hàm đúng trình tự 
    FS.setUpSelectMultiple = (callback) => {
       if($('.selectVariant').length){
        //biến đếm 
        let count = $('.selectVariant').length

        $('.selectVariant').each(function (){
            let _this = $(this);
            let attributeCatalogueId = _this.attr('data-catid')
            if(attribute != ''){
                $.get('/ajax/attribute/loadAttribute',{
                    attribute: attribute,
                    attributeCatalogueId: attributeCatalogueId
                }, function(data){
                    if(data.items != 'undefined' && data.items.length){
                        for(let i = 0; i < data.items.length; i++){
                            var option = new Option(data.items[i].text, data.items[i].id, true, true);
                            // sử dụng .trigger('change') để tự render ra bảng khi dữ liệu chọn vẫn còn tron select
                            _this.append(option).trigger('change');
                        }
                    }
                    // nếu mà lùi biến đếm === 0 và tồn tại callback thì gọi lại lại callback
                    if(--count == 0 && callback){
                        callback()
                    }
                })
            }
            FS.getSelect2(_this)
        })
        
       }
    }
    FS.productVariant = () => {
        // bắt lại biến variant bên blade 
        variant = JSON.parse(atob(variant))
        let variantQuantity = window.variantQuantities;

        const findIndexVariantBySku = (sku) => variant.sku.findIndex((item) => item === sku)

        // loop qua từng row và đổ dữ liệu vào 
        $('.variant-row').each(function (index, value){
            let _this = $(this)
            let variantKey = _this.attr('class').match(/tr-variant-(\d+-\d+)/)[1];
            let dataIndex = variant.sku.findIndex(sku => sku.includes(variantKey));
            // console.log(variantKey, dataIndex)
            let newQuantity = variant.quantity[dataIndex]; // giá trị mặc định
            if (variantQuantity && variantQuantity[dataIndex]) {
                newQuantity = variantQuantity[dataIndex].quantity;
            }
            if(dataIndex !== -1){
                let inputHidenFields = [
                    
                    {name: 'variant[quantity][]',class: 'variant_quantity', value: newQuantity},
                    {name: 'variant[sku][]', class: 'variant_sku', value: variant.sku[dataIndex]},
                    {name: 'variant[price][]', class: 'variant_price', value: variant.price[dataIndex]},
                    {name: 'variant[file_name][]', class: 'variant_filename',value: variant.file_name[dataIndex]},
                    {name: 'variant[file_url][]', class: 'variant_fileurl', value: variant.file_url[dataIndex]},
                    {name: 'variant[album][]', class: 'variant_album', value: variant.album[dataIndex]},
                ]
                // đổ vào input trong form variant 
                for(let i = 0; i < inputHidenFields.length; i++) {
                    // tìm đến input có name và đổ dữ liệu vào input
                    _this.find('.'+ inputHidenFields[i].class).val((inputHidenFields[i].value) ? inputHidenFields[i].value : 0)
                }
                // đổ vào input trong td table
                let album = variant.album[dataIndex]
                let variantAvtImage = (album) ? album.split(',')[0] : ''
                _this.find('.td-quantity').html(newQuantity)
                _this.find('.td-price').html(variant.price[dataIndex])
                _this.find('.td-sku').html(variant.sku[dataIndex])
                _this.find('.imageSrc').attr('src', variantAvtImage)
            }
        })
    }
    // gọi hàm
    $(document).ready(function () {
        FS.setUpProductVariant();
        FS.addVariant();
        FS.niceSelect();
        FS.destroyNiceSelect();
        FS.removeAttribute();
        FS.chooseVariantGroup();
        FS.createProductVariant();
        FS.variantAlbum();
        FS.deleteVariantPicture();
        // FS.switchChange();
        FS.updateVariant();
        FS.cancelVariantUpdate();
        FS.saveVariantUpdate();
        FS.setUpSelectMultiple(
            () => {
                FS.productVariant()
            }
        );
    });
})(jQuery);
