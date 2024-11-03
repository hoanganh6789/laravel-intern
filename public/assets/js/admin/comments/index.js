const handleDelete = (id) => {
  showAlertConfirmTrash(() => {
    $(`#delete-comment-${id}`).submit();
  });
};
