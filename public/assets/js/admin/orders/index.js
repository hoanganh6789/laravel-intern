const handleDelete = (id) => {
  showAlertConfirmTrash(() => {
    $(`#delete-order-${id}`).submit();
  });
};
