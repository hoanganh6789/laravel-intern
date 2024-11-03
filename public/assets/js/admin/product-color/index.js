const handleDelete = (id) => {
    showAlertConfirm(() => {
        $(`#product-color-form-delete-${id}`).submit();
    })
}
