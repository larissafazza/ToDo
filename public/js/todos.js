function confirmDelete(id) {
    var confirmacao = confirm("Are you sure you want to delete this record?\nOnce it is deleted, it cannot be recovered...");

    if (confirmacao) {
        var form = document.getElementById('delete-form-' + id);
        form.submit();
    }
}