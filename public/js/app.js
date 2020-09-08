URL_BASE = $('meta[name="URL_BASE"]').attr("content");
CSRF = $('meta[name="csrf-token"]').attr('content');

$('body').on('keypress', '.is-invalid', function () {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').remove();
});

$('body').on('change', '.is-invalid', function () {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').remove();
});

$('body').on('hidden.bs.modal', '#mdl', function (e) {
    $('form', this).remove();
    $('video', this).remove();
});

$('body').on('hidden.bs.modal', '#mdlLg', function (e) {
    let loading = $('.loading-video', this);
    loading.attr('data-show', 'false');
    $('form', this).remove();
    $('video', this).remove();

});

$('body').on('keypress', '[data-format="money"]', function (e) {
    if (e.which !== 8 && isNaN(String.fromCharCode(e.which))) {
        e.preventDefault();
    }
});

$('body').on('keyup', '[data-format="money"]', function (e) {
    var value = clear_format($(this).val());
    if (value === "") {
        return;
    }
    $(this).val(number_format(value, 0, '.', '.'));
});

function clearFormFormat() {
    $('[data-format="money"]').each(function (index) {
         var value = clear_format($(this).val());
         $(this).val(value);
    });
}

function addFormFormat() {
    $('[data-format="money"]').each(function (index) {
         var value = number_format($(this).val(), 0, '.', '.');
         $(this).val(value);
    });
}

function showErrors(errors) {
    let data = errors.responseJSON.errors;

    if (data) {
        $(".is-invalid").each(function () {
            $(this).removeClass('is-invalid');
        });
        $(".invalid-feedback").each(function () {
            $(this).remove();
        });
        for (var column in data) {

            let name = null;
            if (data.hasOwnProperty(column)) {
                name = column
                let element = $('[name="' + column + '"]');
                if (element.length === 0) {
                    name = column + '[]';
                }
            }

            if (data.hasOwnProperty(column)) {
                let element = $('[name="' + name + '"]');
                element.addClass('is-invalid');
                let html = `<div class="invalid-feedback">${data[column]}</div>`;
                element.after(html);
            }
        }
    }
}

function clearParamsUrl() {
    let url = window.location.href;
    let newUrl = url.split('?')[0];
    if (url !== newUrl) {
        console.log("Limpar url");
        window.history.pushState({}, document.title, newUrl);
    }
}

function clear_format(number) {
    return number.replace(/\./g, '');
}

function number_format(number, decimals = 0, decPoint = '.', thousandsSep = '.') {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '')
    var n = !isFinite(+number) ? 0 : +number
    var prec = !isFinite(+decimals) ? 0 : Math.abs(decimals)
    var sep = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep
    var dec = (typeof decPoint === 'undefined') ? '.' : decPoint
    var s = ''

    var toFixedFix = function (n, prec) {
        if (('' + n).indexOf('e') === -1) {
            return +(Math.round(n + 'e+' + prec) + 'e-' + prec)
        } else {
            var arr = ('' + n).split('e')
            var sig = ''
            if (+arr[1] + prec > 0) {
                sig = '+'
            }
            return (+(Math.round(+arr[0] + 'e' + sig + (+arr[1] + prec)) + 'e-' + prec)).toFixed(prec)
        }
    }

    // @todo: for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec).toString() : '' + Math.round(n)).split('.')
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep)
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || ''
        s[1] += new Array(prec - s[1].length + 1).join('0')
    }

    return s.join(dec)
}
