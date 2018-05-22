      $('#ca').click(function() {
                $.ajax({
                        type: "POST",
                        url: "api/users",
                        processData: false,
                        contentType: "application/json",
                        data: '{ "username": "'+ $("#username").val() +'", "email": "'+ $("#email").val() +'", "password": "'+ $("#password").val() +'","confirmpassword": "'+ $("#confirmpassword").val() +'" }',
                        success: function(r) {
                                console.log(r);
                                document.location.replace('http://upgrade.loc/login.html');
                        },
                        error: function(r) {
                                setTimeout(function() {
                                $('[data-bs-hover-animate]').removeClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'));
                                }, 2000)
                                $('[data-bs-hover-animate]').addClass('animated ' + $('[data-bs-hover-animate]').attr('data-bs-hover-animate'))
                                console.log(r)
                        }
                });
        });