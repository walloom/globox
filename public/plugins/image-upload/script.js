
$('body').on('click', '.btnUploadImage', function (event) {

    let container = $(this);
    event.preventDefault();

    getImageWeb().then((image) => {
        $('[name="image_base_64"]').val(image);
        var img = document.getElementById("previewImg");
        img.src = image;
        $('.empty', container).addClass('d-none').removeClass('d-flex');
        $('.with-image', container).addClass('d-flex').removeClass('d-none');

    });

});

function getImageWeb() {

    return new Promise(function (resolve) {

        const canvasEl = document.createElement("canvas");
        let cx = canvasEl.getContext('2d');

        let width = 1280;
        let height = 1280;
        canvasEl.width = width;
        canvasEl.height = height;

        let input = document.getElementById("inputUploadImage");

        input.type = "file";
        input.accept = "image/*";
        input.multiple = false;
        input.name = 'files';

        input.click();

        console.log(input);

        input.onchange = (event) => {
            var img = new Image;

            if (event.target.files && event.target.files.length > 0) {

                let file = event.target.files[0];
                let type = "image/jpeg";

                img.onload = () => {
                    var iw = img.width;
                    var ih = img.height;
                    var scale = Math.min((width / iw), (height / ih));
                    var iwScaled = iw * scale;
                    var ihScaled = ih * scale;
                    canvasEl.width = iwScaled;
                    canvasEl.height = ihScaled;
                    cx.drawImage(img, 0, 0, iwScaled, ihScaled);
                    let imageBase64 = canvasEl.toDataURL(type);

                    input.value = "";
                    input.onchange = null;
                    resolve(imageBase64);

                }
                img.src = URL.createObjectURL(event.target.files[0]);
            }
        }

    });

}



