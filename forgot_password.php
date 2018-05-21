<?php
include('./classes/DB.php');
include('./api/Mail.php');

if (isset($_POST['resetpassword'])){
    $cstrong = True;
    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
    $email=$_POST['email'];
    $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
    DB::query('INSERT INTO password_tokens VALUES (null, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
    Mail::sendMail('Forgot Password!', "<a href='http://kursadarbs.loc/change_password.php?token=$token'>change_password.php?token=$token</a>", $email);
    echo 'Email sent!';
    echo '<br/>';
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialNetwork</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div class="login-clean">
        <form method="post" action="forgot_password.php">     
            <h2 class="sr-only">Forgot password</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group">
                <input class="form-control" type="text" name="email" value="" placeholder="Email"><br>
                <input class="btn btn-primary btn-block" type="submit" name="resetpassword" value="Reset password">  
            </div>
            <a href="login.html" class="forgot">Already got an account? Click here!</a>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
 
</body>

</html>
