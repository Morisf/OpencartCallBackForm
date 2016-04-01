var submitFeedback = function () {
    /home/moris/Work/FeedBackForm/catalog/view/javascript/feedback.js
    var name = $('#feedback_name');
    var email = $('#feedback_email');
    var phone = $('#feedback_phone');

    if (validate(name, email, phone) === false) {
        return false;
    }

    $.post('/index.php?route=module/feedback',
        {
            'name': $(name).val(),
            'email': $(email).val(),
            'phone': $(phone).val(),
        })
        .success(function () {
            $(name).val('');
            $(email).attr('');
            $(phone).attr('');
            $('#feedback_success').show(0).delay(5000).hide(0);
        })

        .fail(function () {
            $('#feedback_error').show(0).delay(5000).hide(0);
        })
}

var validate = function (name, email, phone) {

    var nameVal = $(name).val();
    if (nameVal.length < 3 || nameVal.length > 32) {
        $(name).parent().addClass('has-error');
        $('#feedback_error').show(0).delay(5000).hide(0);
        return false;
    } else {
        $(name).parent().removeClass('has-error');
    }

    var emailVal = $(email).val();
    if (emailVal.length < 3 || emailVal.length > 32) {
        $(email).parent().addClass('has-error');
        $('#feedback_error').show(0).delay(5000).hide(0);
        return false;
    } else {
        $(email).parent().removeClass('has-error');
    }

    var phoneVal = $(phone).val();
    if (phoneVal.length > 15 || phoneVal.length < 6) {
        $(phone).parent().addClass('has-error');
        $('#feedback_error').show(0).delay(5000).hide(0);
        return false;
    } else {
        $(phone).parent().removeClass('has-error');
    }
}
