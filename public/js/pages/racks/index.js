
let modal = $('#mdlLg');

$('body').on('click', '[data-click="open"]', (e) => {

    e.preventDefault();
    let element = $(e.target);
    let id = element.parent().data('rackid');
    let bodegaId = element.parent().data('bodega');

    if (id && bodegaId) {
        showModal();
        edit(id, bodegaId).done((response) => {
            if (response.view) {
                $('.modal-content', modal).html(response.view);
            }
        });
    }

});

$('body').on('submit', '#frmRack', function (event) {
    event.preventDefault();
    let method = $('input[name="_method"]').val();
    if (method === "PUT") {
        formUpdate();
    }
    return false;
});

$('body').on('click', '[data-click="ubication"]', (e) => {

    let current = $(e.currentTarget);
    let bodegaId = current.data('bodega');
    let rackId = current.data('rack');
    let id = current.data('id');

    showUbication(bodegaId, rackId, id).done((response) => {
        if (response.view) {
            $('#containerUbication').html(response.view);
        }
    });
});

$('body').on('click', '[data-click="avalible"]', (e) => {

    let current = $(e.currentTarget);
    let bodegaId = current.data('bodega');
    let rackId = current.data('rack');
    let id = current.data('id');
    let status = current.data('status');

    availableUbication(bodegaId, rackId, id, status).done((response) => {
        if (response.viewUbication) {
            $('#containerUbication').html(response.viewUbication);
        }
        if (response.viewPreview) {
            $('#containerRackPreview').html(response.viewPreview);
        }
        if (response.viewSections) {
            $("#sectionWidget").html(response.viewSections);
            initGridStack();
        }
    });

});

function formUpdate() {

    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');

    let form = $('#frmRack');
    let id = $('input[name="id"]', form).val();
    let bodegaId = $('input[name="bodega_id"]', form).val();

    update(id, bodegaId).done((response) => {


        $("#sectionWidget").html(response.viewSections);
        initGridStack();

        loading.attr('data-show', 'true');
        modal.modal('hide');

    }).fail((errors) => {
        loading.attr('data-show', 'false');
        showErrors(errors);
    });

}

function update(id, bodegaId) {
    let form = $('#frmRack').serialize();
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/racks/${id}/update`,
        method: "PUT",
        dataType: "json",
        data: form
    });
}

function edit(id, bodegaId) {

    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/racks/${id}/edit`,
        method: "GET",
        dataType: "json"
    });
}

function showModal() {

    modal.modal('show');
    let loading = $('.loading', modal);
    loading.attr('data-show', 'true');
}

function showUbication(bodegaId, rackId, id) {

    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/racks/${rackId}/ubications/${id}/show`,
        method: "GET",
        dataType: "json"
    });
}

function availableUbication(bodegaId, rackId, id, status) {

    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/racks/${rackId}/ubications/${id}/available`,
        method: "PUT",
        dataType: "json",
        data: {status: status}
    });
}


