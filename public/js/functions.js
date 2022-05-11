$(document).on('change', '.file-input', function () {
    let filesCount = $(this)[0].files.length;
    let textbox = $(this).prev();

    if (filesCount === 1) {
        let fileName = $(this).val().split('\\').pop();
        textbox.text(fileName);
    } else {
        textbox.text(filesCount + ' files selected');
    }

    if (typeof (FileReader) != "undefined") {
        let dvPreview = $(this).parent().next('.file-input-preview');//"#divImageMediaPreview");
        dvPreview.html("");
        $($(this)[0].files).each(function () {
            let file = $(this);
            let reader = new FileReader();
            reader.onload = function (e) {
                let img = $("<img />");
                img.attr("src", e.target.result);
                dvPreview.append(img);
            }
            reader.readAsDataURL(file[0]);
        });
    } else {
        alert("This browser does not support HTML5 FileReader.");
    }
});

function hideModal(id){
    const modal = document.getElementById(id);
    const instance = bootstrap.Modal.getInstance(modal);
    instance.hide();
}

function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}