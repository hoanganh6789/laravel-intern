function previewImage(event) {
  const img = document.getElementById("projectlogo-img");
  img.src = URL.createObjectURL(event.target.files[0]);
}

function initializeSelect2() {
  $("#select-tag-product-multiple").select2({
    placeholder: "Choose tags...",
    allowClear: true,
  });
}

function fetchProductData() {
  return $.get(`${BASE_URL}/api/v1/products`);
}

function renderColorOptions(colors) {
  return colors
    .map((color) => `<option value="${color.id}">${color.name}</option>`)
    .join(" ");
}

function renderSizeOptions(sizes) {
  return sizes
    .map((size) => `<option value=${size.id}>${size.name}</option>`)
    .join(" ");
}

function addColor(colors) {
  $("#color-name-product").show();

  const renderColor = `
      <div class="col-lg-4 mb-3 d-flex gap-1">
        <select name="product_colors[]" class="form-select w-75">
          ${renderColorOptions(colors)}
        </select>
        <button class="btn btn-danger delete-product-color">
          <i class="fa-regular fa-trash-can"></i>
        </button>
      </div>
    `;

  $("#render-product-color").append(renderColor);
}

function addSize(sizes) {
  $("#size-name-product").show();

  const renderSize = `
      <div class="col-lg-4 mb-3 d-flex gap-1">
        <select name="product_sizes[]" class="form-select w-75">
          ${renderSizeOptions(sizes)}
        </select>
        <button class="btn btn-danger delete-product-size">
          <i class="fa-regular fa-trash-can"></i>
        </button>
      </div>
    `;

  $("#render-product-size").append(renderSize);
}

function handleDelete() {
  $(document).on(
    "click",
    ".delete-product-color, .delete-product-size",
    function () {
      $(this).closest("div").remove();
    }
  );
}

$(document).ready(function () {
  let colors = [];
  let sizes = [];

  initializeSelect2();

  $("#color-name-product").hide();
  $("#size-name-product").hide();

  fetchProductData().done(function (res) {
    colors = res.data.productColors;
    sizes = res.data.productSizes;
  });

  $("#product-btn-add-color").click(function () {
    addColor(colors);
  });

  $("#product-btn-add-size").click(function () {
    addSize(sizes);
  });

  $("#submit-create-form-product").click(function () {
    $("#form-create-product").submit();
  });

  //   $("#render-tbody-product").click(function () {});

  handleDelete();
});
