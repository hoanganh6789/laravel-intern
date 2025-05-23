$(document).ready(function () {
  const initSelect2 = (selector, placeholder) => {
    $(selector).select2({
      placeholder: placeholder,
    });
  };

  initSelect2("#city", "Chọn Tỉnh Thành");
  initSelect2("#district", "Chọn Quận Huyện");
  initSelect2("#ward", "Chọn Phường Xã");

  const loadData = (url, target, placeholder) => {
    $.getJSON(url, (data) => {
      if (data.error == 0) {
        $(target).html('<option value="0">' + placeholder + "</option>");
        $.each(data.data, function (key, val) {
          $(target).append(
            '<option value="' + val.id + '">' + val.full_name + "</option>"
          );
        });
        initSelect2(target, placeholder);
      }
    });
  };

  loadData(
    "https://esgoo.net/api-tinhthanh/1/0.htm",
    "#city",
    "Chọn Tỉnh Thành"
  );

  $("#city").change(function () {
    let idtinh = $(this).val();
    loadData(
      "https://esgoo.net/api-tinhthanh/2/" + idtinh + ".htm",
      "#district",
      "Chọn Quận Huyện"
    );
    $("#ward").html('<option value="0">Chọn Phường Xã</option>'); // Reset ward
  });

  $("#district").change(function () {
    let idquan = $(this).val();
    loadData(
      "https://esgoo.net/api-tinhthanh/3/" + idquan + ".htm",
      "#ward",
      "Chọn Phường Xã"
    );
  });

  

});
