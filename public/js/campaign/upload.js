$(document).ready(function() {
    // Use the payform library to format and validate
    // the payment fields.

    $('#cardNumber').payform('formatCardNumber');
    $("#cvv").payform('formatCardCVC');


    $('#cardNumber').keyup(function() {

        $("#amex").removeClass('transparent');
        $("#visa").removeClass('transparent');
        $("#mastercard").removeClass('transparent');

        if ($.payform.validateCardNumber($('#cardNumber').val()) == false) {
            $('#card-number-field').addClass('has-error');
        } else {
            $('#card-number-field').removeClass('has-error');
            $('#card-number-field').addClass('has-success');
        }

        if ($.payform.parseCardType($('#cardNumber').val()) == 'visa') {
            $("#mastercard").addClass('transparent');
            $("#amex").addClass('transparent');
        } else if ($.payform.parseCardType($('#cardNumber').val()) == 'amex') {
            $("#mastercard").addClass('transparent');
            $("#visa").addClass('transparent');
        } else if ($.payform.parseCardType($('#cardNumber').val()) == 'mastercard') {
            $("#amex").addClass('transparent');
            $("#visa").addClass('transparent');
        }
    });

    $('.dropdown-item').click(function(e) {
        e.preventDefault();
        var target = $(e.target);
        var key = target.attr('data-key');
        var value = target.text();
        $('#' + key).val(value);
        $('#dropdown-' + key).text(value);
    });
});

function onChangePostFile(e) {
    var fileElem = e.target;
    var imgElem = document.getElementById('preview_image');
    var videoElem = document.getElementById('preview_video');
    var file = fileElem.files[0];
    var fr = new FileReader();
    fr.onload = function(e) {
        imgElem.style = '';
        imgElem.src = this.result;
    };
    switch (file.type) {
        case 'image/jpeg':
        case 'image/jpg':
        case 'image/png':
            fr.readAsDataURL(file);
            break;
        default:
            videoElem.style = '';
            videoElem.src = URL.createObjectURL(file);
    }
}

function onNotificationChange(e) {
    var totalamount = Number(e.target.value) * 0.001;
    document.querySelector('input[name=totalamount]').value = totalamount.toFixed(3);
}

function onSubmitPostForm(e) {
    var isCardValid = $.payform.validateCardNumber($('#cardNumber').val());
    var isCvvValid = $.payform.validateCardCVC($("#cvv").val());

    if ($('#owner').val().length < 5){
        alert("Card owner name is invalid!");
        return;
    } else if (!isCardValid) {
        alert("Card number is invalid!");
        return;
    } else if (!isCvvValid) {
        alert("CVV is invalid!");
        return;
    }

    var formElem = e.target;
    var userId = formElem.getAttribute('userid');
    var postType = true ? 1 : 2;
    var type = 0;
    var cardType = $.payform.parseCardType($('#cardNumber').val());
    var cardExpiry = $('#expiration-date select')[0].value + '/' + $('#expiration-date select')[1].value;

    var form = new FormData(formElem);
    form.append("user_id", userId);
    form.append("posttype", postType);
    form.append("type", type);
    form.append("card_type", cardType);
    form.append("card_expiry", cardExpiry);
    // form.append("post_image", fileInput.files[0], "/C:/Users/MonnaLeeza/Pictures/1.MOV");
    // form.append("thumb_image", fileInput.files[0], "/C:/Users/MonnaLeeza/Pictures/1.jpeg");

    var settings = {
    //   "url": "http://localhost:8000/api/v1/user/create_post",
      "url": "https://admessengerappbackend.com:8080/api/v1/user/create_post",
      "method": "POST",
      "timeout": 0,
      "processData": false,
      "mimeType": "multipart/form-data",
      "contentType": false,
      "data": form
    };

    $.ajax(settings).done(function (response) {
      console.log(response);
    });

    e.preventDefault();
}
