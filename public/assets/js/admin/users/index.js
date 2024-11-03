const handleDelete = (user) => {
  showAlertConfirm(() => {
    $(`#delete-user-${user.id}`).submit();
  });
};

const handleDeleteTrashs = (id) => {
  showAlertConfirmTrash(() => {
    $(`#form-delete-trashs-${id}`).submit();
  });
};
