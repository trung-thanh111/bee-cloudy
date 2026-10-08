(function ($) {
    "use strict";
    var FS = {};

    FS.renderProvinces = () => {
        let province = $("#province");
        let district = $("#district");
        let ward = $("#ward");
        let url =
            "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json";
        let province_id = window.province_id;
        let district_id = window.district_id;
        let ward_id = window.ward_id;
        province
            .empty()
            .append(
                '<option value="0" selected>[ Chọn Tỉnh/Thành phố ]</option>'
            );
        district
            .empty()
            .append('<option value="0" selected>[ Chọn Quận/Huyện ]</option>');
        ward.empty().append(
            '<option value="0" selected>[ Chọn Phường/Xã ]</option>'
        );

        $.getJSON(url, function (data) {
            $.each(data, function (index, item) {
                let isSelected = item.Id == province_id ? "selected" : "";
                let option = `<option value="${item.Id}" ${isSelected}>${item.Name}</option>`;
                province.append(option);
            });
            // tự động trgger khi có id
            if (province_id) {
                province.trigger("change");
            }
        });

        province.on("change", function () {
            let provinceId = $(this).val();
            district
                .empty()
                .append(
                    '<option value="0" selected>[ Chọn Quận/Huyện ]</option>'
                );
            ward.empty().append(
                '<option value="0" selected>[ Chọn Phường/Xã ]</option>'
            );

            if (provinceId !== "0") {
                $.getJSON(url, function (data) {
                    let districts = data.find(
                        (p) => p.Id === provinceId
                    ).Districts;
                    $.each(districts, function (index, item) {
                        let isSelected = item.Id == district_id ? "selected" : "";
                        let option = `<option value="${item.Id}" ${isSelected}>${item.Name}</option>`;
                        district.append(option);
                    });
                    if (district_id) {
                        district.trigger("change");
                    }
                });
            }
        });

        district.on("change", function () {
            let provinceId = province.val();
            let districtId = $(this).val();
            ward.empty().append(
                '<option value="0" selected>[ Chọn Phường/Xã ]</option>'
            );

            if (districtId !== "0") {
                $.getJSON(url, function (data) {
                    let districts = data.find(
                        (p) => p.Id === provinceId
                    ).Districts;
                    let wards = districts.find(
                        (d) => d.Id === districtId
                    ).Wards;
                    $.each(wards, function (index, item) {
                        let isSelected = item.Id == ward_id ? "selected" : "";
                        let option = `<option value="${item.Id}" ${isSelected}>${item.Name}</option>`;
                        ward.append(option);
                    });
                    if (ward_id) {
                        ward.trigger("change");
                    }
                });
            }
        });
    };

    FS.getNameById = () => {
        $("#province, #district, #ward").on("change", function () {
            let provinceName = $("#province option:selected").text();
            let districtName = $("#district option:selected").text();
            let wardName = $("#ward option:selected").text();

            $("#province_name").val(provinceName);
            $("#district_name").val(districtName);
            $("#ward_name").val(wardName);
        });
    };

    $(document).ready(function () {
        FS.renderProvinces();
        FS.getNameById();
    });
})(jQuery);
