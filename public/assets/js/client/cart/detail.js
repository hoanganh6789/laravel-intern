// $(document).ready(function () {});

$(function () {
  $(".btn-add-qty").click(function () {
    const id = $(this).data("id");

    let qty = parseInt($(`.data-qty-${id}`).val());
    qty++;
    $(`.data-qty-${id}`).val(qty);

    handleUpdateQuantity(id, qty);
  });

  $(".btn-remove-qty").click(function () {
    const id = $(this).data("id");
    let qty = parseInt($(`.data-qty-${id}`).val());

    if (qty > 1) {
      qty--;
      $(`.data-qty-${id}`).val(qty);

      handleUpdateQuantity(id, qty);
    }
  });

  const handleUpdateQuantity = (id, quantity) => {
    $.ajax({
      url: `${BASE_URL}/ajax/cart/update`,
      method: "POST",
      data: {
        id: id,
        quantity: quantity,
      },
      success: (res) => {
        console.log(res);
        $(`.sub-price-${id}`).text(formatPrice(res.subTotal));
        $("#total-price").text(formatPrice(res.total));
        showToastr('success', 'Sửa thành công');
      },
      error: (err) => {
        console.error(err);
      },
    });
  };
});
