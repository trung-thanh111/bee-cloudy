(function ($) {
    "use strict";
    var FS = {};

    FS.renderProvinces = () => {
        let province = $("#province");
        let district = $("#district");
        let ward = $("#ward");
        let url =
            "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json";

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
                let option = `<option value="${item.Id}">${item.Name}</option>`;
                province.append(option);
            });
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
                        let option = `<option value="${item.Id}" >${item.Name}</option>`;
                        district.append(option);
                    });
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
                        let option = `<option value="${item.Id}">${item.Name}</option>`;
                        ward.append(option);
                    });
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
