let selectColorId = null;
let selectSizeId = null;

$(document).ready(function () {
  // lấy id của color được chọn
  $(".filter-color").click(function () {
    selectColorId = $(this).data("color-id");
  });
  // lấy id của size được chọn
  $(".filter-size").click(function () {
    selectSizeId = $(this).data("size-id");
  });

  //  nút thêm vào giỏ hàng
  $("#btn-add-cart").click(function () {
    let productId = $(this).attr("data-product-id");
    let productQty = $("#product-quantity").val();

    // nếu button add không có disabled mới handle
    if (!$(this).hasClass("disabled")) {
      fetchVariantId(productId, selectSizeId, selectColorId).done(function (
        res
      ) {
        handleAddToCart(productId, productQty, res.variantId);
      });
    }
  });

  const fetchVariantId = (productId, sizeId, colorId) => {
    return $.get(
      `${BASE_URL}/api/v1/products/${productId}/${sizeId}/${colorId}/variants`
    );
  };

  const handleAddToCart = (productId, qty, variantId) => {
    $.ajax({
      url: `${BASE_URL}/ajax/cart/add`,
      type: "POST",
      data: {
        product_variant_id: variantId,
        quantity: qty,
      },
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
      success: (res) => {
        console.log(res);

        if(!res.status){
            showAlert('error', `${res.message}`, 'LuxChill Thông Báo');
        }else{
            showAlert('success', `${res.message}`, 'LuxChill Thông Báo');
        }

      },
      error: (err) => {
        console.error(err);
      },
    });
    // console.log(`product id: ${productId}`);
    // console.log(`Qty: ${qty}`);
    // console.log(`Variant Id: ${variantId}`);
  };
});
