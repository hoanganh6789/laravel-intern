const handleDelete = (id) => {
  showAlertConfirm(() => {
    $(`#product-size-form-delete-${id}`).submit();
  });
};
