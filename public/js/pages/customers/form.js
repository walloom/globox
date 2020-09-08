

initSelectCountry();
initSelectState();
initCity();
initCurrency();

function initSelectCountry() {
    $('[name="country_id"]').select2({
        theme: 'bootstrap4'
    }).on('select2:select', function (e) {

        var data = e.params.data;
        let id = data.id;
        loadStates(id).done((response) => {
           
            if (response.viewStates) {
                $('#colStates').html(response.viewStates);
                initSelectState();
            }
            if (response.viewCities) {
                $('#colCities').html(response.viewCities);
                initCity();
            }
        });

    });
}

function initSelectState() {

    $('[name="state_id"]').select2({
        theme: 'bootstrap4'
    }).on('select2:select', function (e) {

        var data = e.params.data;
        let id = data.id;
        loadCities(id).done((response) => {
          
            if (response.viewCities) {
                $('#colCities').html(response.viewCities);
                initCity();
            }
        });


    });
}

function initCity() {
    $('[name="city_id"]').select2({
        theme: 'bootstrap4'
    });
}

function initCurrency() {
    $('[name="currency_id"]').select2({
        theme: 'bootstrap4'
    });
}

function loadStates(id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/load-states/${id}`,
        method: "GET",
        dataType: "json"
    });
}

function loadCities(id) {
    return $.ajax({
        headers: {
            'X-CSRF-TOKEN': CSRF
        },
        url: `${URL_BASE}/empresa/customers/load-cities/${id}`,
        method: "GET",
        dataType: "json"
    });
}