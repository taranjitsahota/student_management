<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register</title>
</head>

<body>
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }

        body {
            margin: 0;
            color: #6a6f8c;
            background: #c8c8c8;
            font: 600 16px/18px 'Open Sans', sans-serif;
        }

        .container {
            background: url('{{ asset('images/login.jpg') }}') no-repeat center;
            background-size: cover;
            background-position: center;
            width: 100vw;
            /* 100% of the viewport width */
            height: 100vh;
            /* 100% of the viewport height */
            position: fixed;
            top: 0;
            left: 0;
        }


        .login-box {
            width: 100%;
            margin: auto;
            max-width: 525px;
            min-height: 670px;
            position: relative;
            /* background: url(https://images.unsplash.com/photo-1507208773393-40d9fc670acf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1268&q=80) no-repeat center; */
            box-shadow: 0 12px 15px 0 rgba(0, 0, 0, .24), 0 17px 50px 0 rgba(0, 0, 0, .19);
        }

        .login-snip {
            width: 100%;
            height: 100%;
            position: absolute;
            padding: 90px 70px 50px 70px;
            background: rgb(78 11 11 / 90%);
        }

        .login-snip .login,
        .login-snip .sign-up-form {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
            transform: rotateY(180deg);
            backface-visibility: hidden;
            transition: all .4s linear;
        }

        .login-snip .sign-in,
        .login-snip .sign-up,
        .login-space .group .check {
            display: none;
        }

        .login-snip .tab,
        .login-space .group .label,
        .login-space .group .button {
            text-transform: uppercase;
        }

        .login-snip .tab {
            font-size: 22px;
            margin-right: 15px;
            padding-bottom: 5px;
            margin: 0 15px 10px 0;
            display: inline-block;
            border-bottom: 2px solid transparent;
        }

        .login-snip .sign-in:checked+.tab,
        .login-snip .sign-up:checked+.tab {
            color: #fff;
            border-color: #1161ee;
        }

        .login-space {
            min-height: 345px;
            position: relative;
            perspective: 1000px;
            transform-style: preserve-3d;
        }

        .login-space .group {
            margin-bottom: 15px;
        }

        .login-space .group .label,
        .login-space .group .input,
        .login-space .group .button {
            width: 100%;
            color: #fff;
            display: block;
        }

        .login-space .group .input,
        .login-space .group .button {
            border: none;
            padding: 15px 20px;
            border-radius: 25px;
            background: rgba(255, 255, 255, .1);
        }

        .login-space .group input[data-type="password"] {
            text-security: circle;
            -webkit-text-security: circle;
        }

        .login-space .group .label {
            color: #aaa;
            font-size: 12px;
        }

        .login-space .group .button {
            background: #1161ee;
        }

        .login-space .group label .icon {
            width: 15px;
            height: 15px;
            border-radius: 2px;
            position: relative;
            display: inline-block;
            background: rgba(255, 255, 255, .1);
        }

        .login-space .group label .icon:before,
        .login-space .group label .icon:after {
            content: '';
            width: 10px;
            height: 2px;
            background: #fff;
            position: absolute;
            transition: all .2s ease-in-out 0s;
        }

        .login-space .group label .icon:before {
            left: 3px;
            width: 5px;
            bottom: 6px;
            transform: scale(0) rotate(0);
        }

        .login-space .group label .icon:after {
            top: 6px;
            right: 0;
            transform: scale(0) rotate(0);
        }

        .login-space .group .check:checked+label {
            color: #fff;
        }

        .login-space .group .check:checked+label .icon {
            background: #1161ee;
        }

        .login-space .group .check:checked+label .icon:before {
            transform: scale(1) rotate(45deg);
        }

        .login-space .group .check:checked+label .icon:after {
            transform: scale(1) rotate(-45deg);
        }

        .login-snip .sign-in:checked+.tab+.sign-up+.tab+.login-space .login {
            transform: rotate(0);
        }

        .login-snip .sign-up:checked+.tab+.login-space .sign-up-form {
            transform: rotate(0);
        }

        *,
        :after,
        :before {
            box-sizing: border-box
        }

        .clearfix:after,
        .clearfix:before {
            content: '';
            display: table
        }

        .clearfix:after {
            clear: both;
            display: block
        }

        a {
            color: inherit;
            text-decoration: none
        }


        .hr {
            height: 2px;
            margin: 60px 0 50px 0;
            background: rgba(255, 255, 255, .2);
        }

        .foot {
            text-align: center;
        }

        .card {
            width: 500px;
            left: 100px;
        }

        ::placeholder {
            color: #b3b3b3;
        }

        .login-snip h4 {
            font-size: 28px;
            /* Increase font size */
            color: #fff;
            /* White color */
            text-align: center;
            /* Center align the text */
            margin-bottom: 40px;
        }
        h4 {
            padding-bottom: 8px;

  border-bottom: 2px solid #fff; /* adjust the width and color to your liking */
}
#registration_error{
    color: red;
    font-size: 14px;
}
    </style>
    <div class="container">
        <div class="login-container">
            <div class="login-box">
                <div class="login-snip">
                    <h4>DPS SCHOOL</h4>
                    <div id="registration-success-message"
                        style="color: green; font-weight: bold; margin-bottom: 10px;"></div>

                    <input id="tab-1" type="radio" name="tab" class="sign-in"><label for="tab-1"
                        class="tab">Login</label>
                    <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2"
                        class="tab">Sign Up</label>
                    <div class="login-space">
                        <form action="" id="login_form" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="login">
                                <div class="group">
                                    <label for="email" class="label">Email</label>
                                    <input id="email" name="email" type="text" class="input"
                                        placeholder="Enter your email">
                                    <span class="error-message" id="loginemail-error"></span>

                                </div>
                                <div class="group">
                                    <label for="password" class="label">Password</label>
                                    <input id="password" name="password" type="password" class="input"
                                        data-type="password" placeholder="Enter your password">
                                    <span class="error-message" id="loginpassword-error"></span>

                                </div>
                                <div class="group">
                                    <input id="check" type="checkbox" class="check">
                                    <label for="check"><span class="icon"></span> Keep me Signed in</label>
                                </div>
                                <div class="group">
                                    {{-- <input type="submit" class="button" value="Sign In"> --}}
                                    <input type="submit" class="button" value="Log In">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                        <form id="register_form" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="sign-up-form">
                                <div class="group">
                                    <label for="name" class="label">Username</label>
                                    <input name="name" id="name" type="text" class="input"
                                        placeholder="Create your Username" autocomplete="off">
                                    <span class="error-message" id="name-error"></span>
                                </div>
                                <div class="group">
                                    <label for="email" class="label">Email Address</label>
                                    <input id="registeremail" name="email" type="text" class="input"
                                        placeholder="Enter your email address">
                                    <span class="error-message" id="email-error"></span>
                                </div>
                                <div id="registration_error"></div>
                                <div class="group">
                                    <label for="password" class="label">Password</label>
                                    <input id="registerpassword" name="password" type="password" class="input"
                                        placeholder="Create your password">
                                    <span class="error-message" id="password-error"></span>
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" value="Sign Up">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <label for="tab-1">Already Member?</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#register_form').on('submit', function(event) {
                event.preventDefault();


                $('.error-message').text('');


                var name = $('#name').val().trim();
                var email = $('#registeremail').val().trim();
                var password = $('#registerpassword').val().trim();
                var errors = false;

                if (name.length < 1) {
                    $('#name-error').text('Name is required');
                    errors = true;
                }

                if (email.length < 1) {
                    $('#email-error').text('Email is required');
                    errors = true;
                }

                if (password.length < 1) {
                    $('#password-error').text('Password is required');
                    errors = true;
                }
                if (errors) {
                    return;
                }


                $.ajax({
                    type: "POST",
                    url: "{{ route('register.post') }}",
                    data: new FormData(this),
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(response) {

                        $('#name').val('');
                        $('#registeremail').val('');
                        $('#registerpassword').val('');
                        $('#registration_success').text(
                            'Registration successful! Please login.');
                        $('#tab-1').prop('checked', true); // Activate the Login tab
                        $('.login').css('transform', 'rotateY(0)'); // Show the Login form
                        $('.sign-in').prop('checked',
                            true); // Ensure Sign-In radio button is selected

                        // Optionally, you can show a success message or perform other actions
                        console.log('Registration successful');
                    },
                    error: function(xhr, status, error) {
        var errorMessage = xhr.responseJSON.message;
        $('#registration_error').text(errorMessage); // Display the error message
        console.error('Error:', error);
    }
                });
            });
            $('#login_form').on('submit', function(event) {
                event.preventDefault();

                var loginemail = $('#email').val().trim();
                var loginpassword = $('#password').val().trim();

                if (loginemail.length < 1) {
                    $('#loginemail-error').text('Email is required');
                }

                if (loginpassword.length < 1) {
                    $('#loginpassword-error').text('Password is required');
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('login.post') }}",
                    data: {
                        email: loginemail,
                        password: loginpassword
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                        if ($.isEmptyObject(data.error)) {
                            if (data.success) {
                                // alert('123');
                                window.location.href     = "{{ url('/home') }}"
                            } else {
                                alert('Not registered or invalid credentials')
                            }
                         } else {
                             alert('Not registered or invalid credentials')
                         }
                    }
                });
            });
        });
    </script>


</body>

</html>
