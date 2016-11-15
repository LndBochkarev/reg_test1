
$(document).ready(function () {

    
    var pass = $('#password');
    var passHint = $('#password + .form_hint');
    var defHintColor = passHint.css('color');

    if (!passHint.length) {
        passHint = '<div class="form_hint"></div>';
        pass.after(passHint);
        passHint = $('#password + .form_hint');
    }

    pass.keypress(function () {
        var passLength = pass.val().length;

        if (passLength < 6) {
            passHint.text("Password strength: unacceptable");
            passHint.css('color', 'red');
        } else if (passLength >= 6) {
            passHint.text("Password strength: weak");
            passHint.css('color', 'blue');
        }



    });






    passHint.click(function () {
        //$(this).hide();
    });


});

      