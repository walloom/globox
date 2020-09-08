let modal = $('#mdl');

$('body').on('click', '[data-click="delete"]', function (event) {
    event.preventDefault();
    showModal();
    let id = $(this).data('id');
    _delete(id).done((response) => {
        if (response.view) {
            $('.modal-content', modal).html(response.view);
        }
    });
});


$('body').on('submit', '#frmCustomerDelete', function (event) {
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
    
    let form = $('#frmCustomerDelete');
    let id = $('input[name="id"]', form).val();
    
    destroy(id).done((response) => {

        $("#table").html(response.view);
        loading.attr('data-show', 'true');
        modal.modal('hide');

    }).fail((errors)=>{
        loading.attr('data-show', 'false');
        showErrors(errors);
    });

}


function showModal() {
    modal.modal('show');
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
}

function _delete(id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/${id}/delete`,
        method: "GET",
        dataType: "json"
    });
}

function destroy(id) {
    let form = $('#frmCustomerDelete').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/${id}/destroy`,
        method: "delete",
        dataType: "json",
        data: form
    });
}
