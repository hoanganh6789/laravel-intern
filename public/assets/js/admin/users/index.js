const handleDelete = (user) => {
    showAlertConfirm(() => {
        $(`#delete-user-${user.id}`).submit()
    })
}
