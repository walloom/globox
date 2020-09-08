

initGridStack();

function log(type, items) {

    let x = null;
    let y = null;
    let w = null;
    let h = null;
    let id = null;
    let bodegaId = null;
    let el = null;

    items.forEach(function (item) {
        el = $(item.el);
        id = el.data('id');
        bodegaId = el.data('bodega');
        type = el.data('type');

        x = item.x;
        y = item.y;
        w = item.width;
        h = item.height;
    });

    if (!id) {
        create(bodegaId, type, x, y, w, h, el);
    } else {
        updatePosition(id, bodegaId, type, x, y, w, h, el);
    }

}

function create(bodegaId, type, x, y, w, h, el) {

    store(bodegaId, type, x, y, w, h).done((response) => {

        $('[data-rack="name"]', el).html(response.name).addClass('name');
        $('[data-rack="alias"]', el).html(response.alias).addClass('alias');

        el.attr('data-id', response.id);
        el.data('id', response.id);

        if (type === "rack") {
            el.attr('data-rackid', response.rack.id);
            el.data('rackid', response.rack.id);

            el.attr('data-click', 'open');
            el.data('click', 'open');
        }

    });
}

function updatePosition(id, bodegaId, type, x, y, w, h, el) {
    drag(id, bodegaId, type, x, y, w, h).done((response) => {
       
    });
}

function store(bodegaId, type, x, y, w, h) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/sections/store`,
        method: "POST",
        dataType: "json",
        data: {type: type, x: x, y: y, w: w, h: h}
    });
}

function drag(id, bodegaId, type, x, y, w, h) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/bodegas/${bodegaId}/sections/${id}/drag`,
        method: "PUT",
        dataType: "json",
        data: {type: type, x: x, y: y, w: w, h: h}
    });
}

function initGridStack() {
    
    var grid = GridStack.init({
        float: true,
        cellHeight: '40px',
        compact: true,
        acceptWidgets: '.newWidget'
    });

    grid.on('added', function (e, items) {
        log('added ', items);
    });

    grid.on('change', function (e, items) {
        log('change ', items)
    });

    $('.newWidget').draggable({
        revert: 'invalid',
        scroll: false,
        appendTo: 'body',
        helper: 'clone'
    });
    
}