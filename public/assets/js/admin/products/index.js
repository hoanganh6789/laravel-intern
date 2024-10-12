const handleDelete = (id) => {
//   console.log(id);
  showAlertConfirm(() => {
    showAlert('success', `Delete success product id: ${id}`, 'LuxChill Thông Báo');
    // $(`#delete-product-${id}`).submit();
  });
};
