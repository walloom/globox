$(document).ready(function (evt) {

    $(".triggerFile").on("click", function (evt) {
        $file = $(this).data("file");
        $($file).click();
    });

    $("#btnPrevCustom").on("click", function (evt) {
        $('#designModal').modal('hide');
        $('.divPrev').addClass('active');
    });

    $(".divPrev").on("click", function (evt) {
        $(".divPrev").removeClass("active");
        $('#designModal').modal();
    })

    $("#btnSaveSetting").on("click", function (evt) {

        update().done(() => {
           window.location.reload();
        });

    });

    function update() {
        let form = $('#formCustom').serialize();
        return $.ajax({
            headers: {
                'X-CSRF-TOKEN': CSRF
            },
            url: `${URL_BASE}/settings/save`,
            method: "POST",
            dataType: "json",
            data: form
        });
    }



    $('.primary-color').colorpicker();
    $('.secondary-color').colorpicker();
    $('.primary-color-text').colorpicker();
    $('.secondary-color-text').colorpicker();


    $('.primary-color').on('colorpickerChange', function (event) {
        if (event.color) {
            color1(event.color.toString());
        }
    });

    $('.secondary-color').on('colorpickerChange', function (event) {
        if (event.color) {
            color2(event.color.toString());
        }
    });

    $('.primary-color-text').on('colorpickerChange', function (event) {
        if (event.color) {
            color3(event.color.toString());
        }
    });

    $('.secondary-color-text').on('colorpickerChange', function (event) {
        if (event.color) {
            color4(event.color.toString());
        }
    });

    $(".fileEvt").change(function () {
        readURL(this);
    });

    $(".user-panel").on("click", function (evt) {
        $('#designModal').modal();
    });
    var settingCompany = $("#settingCompany").val();
    if (settingCompany == "") {
        $('#designModal').modal();
    }

})

function color1(color) {
    $('.primary-color .fa-square').css('color', color);
    $(".main-sidebar").css("background-color", color);
    $(".modal-globox .modal-header").css("background-color", color);
    $(".btn-danger").css({
        "background-color": color,
        "border-color": color
    });
}

function color2(color) {

    let style = `background-color:${color} !important`;
    $('.secondary-color .fa-square').css('color', color);
    $(".sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active").attr("style", style);
    $(".main-header").attr("style", style);

}

function color3(color) {
    $('.primary-color-text .fa-square').css('color', color);
    $('.nav-sidebar .nav-item > .nav-link').css('color', color);
    $(".modal-globox .modal-header").css("color", color);

    $(".btn-danger").css({
        "color": color,
    });
}

function color4(color) {

    let style = `color:${color} !important`;
    $('.secondary-color-text .fa-square').css('color', color);
    $('.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active').attr('style', style);
    $(".navbar-light .navbar-nav .nav-link").attr("style", style);
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
            $zBase = $(".zone-photo");
            $zBase.css("background-image", 'url(' + e.target.result + ')');
            $zBase.addClass("active");
            var htmlImg = '<img src="' + e.target.result + '">';
            $(".brand-globox").html(htmlImg);
            $zBase.find(".base64File").val(e.target.result);
            $('.logo-modal').addClass('d-none');
            //console.log( e.target.result );
        }
        reader.readAsDataURL(input.files[0]);
    }
}
