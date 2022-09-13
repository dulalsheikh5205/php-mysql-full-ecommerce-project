$(document).ready(function(){
    var domain = window.location.origin;
    var path = window.location.pathname.split('/');
    var URL = domain + '/' + path[1] +'/'+'M-Ecommerce-Shopping-Project/';
    console.log(URL);


$('#full-form').submit(function(ev){
    ev.preventDefault()
    var username = $('.username').val();
    var password = $('.password').val();

    if(username == '' || password == ''){
        $('#full-form').append('<div class="alert alert-warning" role="alert">username or password must be filled!</div>');
    }else{
        $.ajax({
            url: './php_files/check_login.php',
            type: 'POST',
            data:{login:'1',user:username,pass:password},
            success: function(response){
                $('.alert').hide();
                var responsedata = JSON.parse(response);
                console.log(responsedata);
                if(responsedata.hasOwnProperty('success')){
                    $('#full-form').append('<div class="alert alert-success" role="alert">logged successfull!</div>');
                    setTimeout(function(){window.location = URL+'admin/dashboard.php'},1000);
                }
                else if(responsedata.hasOwnProperty('error')){
                    $('#full-form').append('<div class="alert alert-warning" role="alert">login incorrect!</div>');
                }
                  
            }
        });
    }

});

});