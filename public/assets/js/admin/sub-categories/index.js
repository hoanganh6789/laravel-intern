const handleDelete = (id) => {
  showAlertConfirm(() => {
    $(`#sub-categories-form-delete-${id}`).submit();
  });
};
