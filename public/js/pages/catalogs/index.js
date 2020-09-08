let modal = $('#mdl');

$('body').on('click', '[data-click="delete"]', function (event) {
    event.preventDefault();
    showModal();
    let customer_id = $(this).data('customer');
    let id = $(this).data('id');
    _delete(customer_id, id).done((response) => {
        if (response.view) {
            $('.modal-content', modal).html(response.view);
        }
    });
});


$('body').on('submit', '#frmCatalogDelete', function (event) {
    event.preventDefault();
    let method = $('input[name="_method"]').val();
    if (method === "DELETE") {
        formDestroy();
    }
    return false;
});

function formDestroy() {

    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');

    let form = $('#frmCatalogDelete');
    let customer_id = $('input[name="customer_id"]', form).val();
    let id = $('input[name="id"]', form).val();

    destroy(customer_id, id).done((response) => {

        $("#table").html(response.view);
        loading.attr('data-show', 'true');
        modal.modal('hide');

    }).fail((errors) => {
        loading.attr('data-show', 'false');
        showErrors(errors);
    });

}


function showModal() {
    modal.modal('show');
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
}

function _delete(customer_id, id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/${customer_id}/catalogs/${id}/delete`,
        method: "GET",
        dataType: "json"
    });
}

function destroy(customer_id, id) {
    let form = $('#frmCatalogDelete').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/${customer_id}/catalogs/${id}/destroy`,
        method: "delete",
        dataType: "json",
        data: form
    });
}
