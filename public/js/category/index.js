$(() => {
    // Handlers
    $('.del-category').on('click', function(evt) {
        evt.preventDefault()
        evt.stopPropagation()
        var sure = confirm('¿Está seguro de eliminar la categoría?\nEsta acción es irreversible.')
        if (!sure) {
            return false
        }
        var id = $(this).data('id')
        document.getElementById(`frmDel${id}`).submit();
    })
})