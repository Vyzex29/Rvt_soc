<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Image.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $User=DB::query('SELECT username,profileimg, description FROM users WHERE id=:userid', array(':userid'=>$userid));
} else {
        die('Not logged in');
}

if (isset($_POST['uploadprofileimg'])) {
    Image::uploadImage('profileimg',"UPDATE users SET profileimg= :profileimg WHERE id=:userid", array(':userid'=>$userid));
}
if (isset($_POST['changeDescription'])) {
    $str = str_replace(array("\r\n", "\n", "\r"), ' ', htmlentities($_POST['description']));
   DB::query('UPDATE users SET description=:desc WHERE id=:userid', array(':desc'=>$str, ':userid'=>$userid));
}
?>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Social Network</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
        <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
        <link rel="stylesheet" href="assets/css/Navigation-Clean1.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/index.css">
    </head>

    <body>
        <header class="hidden-sm hidden-md hidden-lg">
            <div class="searchbox">
                <form>
                    <h1 class="text-left">Social Network</h1>
                    <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                        <input class="form-control sbox" type="text">
                        <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span></button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                            <li role="presentation">
                                <?php echo '<a href="profile.php?username='.$User[0]['username'].'">My Profile</a>'?></li>
                            <li class="divider" role="presentation"></li>
                            <li role="presentation"><a href="index.php">Timeline </a></li>
                            <li role="presentation"><a href="messages.php">Messages </a></li>
                            <li role="presentation"><a href="notify.php">Notifications </a></li>
                            <li role="presentation" class="active"><a href="my_account.php">Account Managment</a></li>
                            <li role="presentation"><a href="change_password.php">Password change</a></li>                            
                            <li role="presentation"><a href="logout.php">Logout </a></li>
                        </ul>
                    </div>
                </form>
            </div>
            <hr>
        </header>
        <div>
            <nav class="navbar navbar-default hidden-xs navigation-clean">
                <div class="container">
                    <div class="navbar-header"><a class="navbar-brand navbar-link" href="index.php"><i class="icon ion-ios-navigate"></i></a>
                        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    </div>
                    <div class="collapse navbar-collapse" id="navcol-1">
                        <form class="navbar-form navbar-left">
                            <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                                <input class="form-control sbox" type="text">
                                <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index:100">
                                </ul>
                            </div>
                        </form>
                        <ul class="nav navbar-nav hidden-md hidden-lg navbar-right">
                            <li role="presentation"><a href="index.php">My Timeline</a></li>
                            <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation">
                                        <?php echo '<a href="profile.php?username='.$User[0]['username'].'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
                                    <li role="presentation" class="active" ><a href="my_account.php">Account Managment</a></li>
                                    <li role="presentation"><a href="change_password.php">Password change</a></li>
                                    <li role="presentation"><a href="logout.php">Logout </a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                            <li role="presentation"><a href="index.php">Timeline</a></li>
                            <li role="presentation"><a href="messages.php">Messages</a></li>
                            <li role="presentation"><a href="notify.php">Notifications</a></li>
                            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">User <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation">
                                        <?php echo '<a href="profile.php?username='.$User[0]['username'].'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
                                    <li role="presentation" class="active"><a href="my_account.php">Account Managment</a></li>
                                    <li role="presentation"><a href="change_password.php">Password change</a></li>
                                    <li role="presentation"><a href="logout.php">Logout </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            <div class="timelineposts">
                <div class="row">
                    <h1 class="text-center">My Account</h1>
                    <div class="col-md-6 text-center">
                        <h2>Your Image:</h2>
                        <img src="" data-tempsrc="<?php echo $User[0]['profileimg']?>" class="postimg">

                        <form action="my_account.php" method="post" enctype="multipart/form-data">
                            <div>
                                <h4>Upload a profile image:</h4>
                                <input class="inline-input" type="file" name="profileimg">
                                <button class="btn btn-primary" type="submit" name="uploadprofileimg">Upload Image</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6 text-center">
                        <h2>Your Description:</h2>
                        <p>
                            <?php
                                if(empty($User[0]['description'])){
                                    echo "You don't have a description yet";
                                }else{
                                   echo $User[0]['description']; 
                                }
                                
                            ?>
                        </p>
                        <form action="my_account.php" method="post" enctype="multipart/form-data">
                            <div>
                                <h4>Change your description:</h4>
                                <textarea type="text" name="description" required rows="4" cols="70"></textarea>
                                <button class="btn btn-primary" type="submit" name="changeDescription">Change</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-dark nav navbar-fixed-bottom">
            <footer>
                <div class="container">
                    <p class="copyright">Valerijs Diks© 2017/2018</p>
                </div>
            </footer>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
        <script src="assets/js/my_account.js"></script>
        <script src="assets/js/searchbox.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
