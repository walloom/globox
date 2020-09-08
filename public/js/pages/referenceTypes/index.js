let modal = $('#mdl');

$('body').on('click', '[data-click="create"]', function (event) {
    event.preventDefault();
    showModal();
    create().done((response) => {
        if (response.view) {
            $('.modal-content', modal).html(response.view);
        }
    });
});

$('body').on('click', '[data-click="edit"]', function (event) {
    event.preventDefault();
    showModal();
    let id = $(this).data('id');
    edit(id).done((response) => {
        if (response.view) {
            $('.modal-content', modal).html(response.view);
        }
    });
});

$('body').on('submit', '#frmReferenceType', function (event) {
    event.preventDefault();
    let method = $('input[name="_method"]').val();
    if (method === "POST") {
        formStore();
    }
    if (method === "PUT") {
         formUpdate();
    }
    return false;
});

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

$('body').on('submit', '#frmReferenceTypeDelete', function (event) {
    event.preventDefault();
    let method = $('input[name="_method"]').val();
    if (method === "DELETE") {
        formDestroy();
    }
    return false;
});

function formStore() {

    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');

    store().done((response) => {

        $("#table").html(response.view);
        loading.attr('data-show', 'true');
        modal.modal('hide');
        
        clearParamsUrl();

    }).fail((errors)=>{
        loading.attr('data-show', 'false');
        showErrors(errors);
    });
}

function formUpdate() {
    
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
    
    let form = $('#frmReferenceType');
    let id = $('input[name="id"]', form).val();

    update(id).done((response) => {

        $("#table").html(response.view);
        loading.attr('data-show', 'true');
        modal.modal('hide');

    }).fail((errors)=>{
        loading.attr('data-show', 'false');
        showErrors(errors);
    });

}

function formDestroy() {
    
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
    
    let form = $('#frmReferenceTypeDelete');
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

function create() {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/reference-types/create`,
        method: "GET",
        dataType: "json"
    });
}

function edit(id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/reference-types/${id}/edit`,
        method: "GET",
        dataType: "json"
    });
}

function _delete(id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/reference-types/${id}/delete`,
        method: "GET",
        dataType: "json"
    });
}

function showModal() {
    modal.modal('show');
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
}

function store() {
    let form = $('#frmReferenceType').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: URL_BASE + "/empresa/reference-types",
        method: "POST",
        dataType: "json",
        data: form
    });
}

function update(id) {
    let form = $('#frmReferenceType').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/reference-types/${id}`,
        method: "PUT",
        dataType: "json",
        data: form
    });
}

function destroy(id) {
    let form = $('#frmReferenceTypeDelete').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/reference-types/${id}/destroy`,
        method: "delete",
        dataType: "json",
        data: form
    });
}
