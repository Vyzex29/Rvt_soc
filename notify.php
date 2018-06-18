<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (!Login::isLoggedIn()) {
    header('Location: login.html');
    die;
}else{
    $userid=Login::isLoggedin();
$user = DB::query('SELECT username, profileimg FROM users WHERE id=:userid', array(':userid'=>$userid));

}?>
<!DOCTYPE html>
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
                <h1 class="text-left">RVT SOC</h1>
                    <div class="searchbox"><i class="glyphicon glyphicon-search"></i>
                    <input class="form-control sbox" type="text">
                    <ul class="list-group autocomplete" style="position:absolute;width:100%; z-index: 100">
                    </ul>
                </div>
                <div class="dropdown">
                     <button class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">MENU <span class="caret"></span> 
                    <img src="" data-tempsrc="<?php echo $user[0]['profileimg']?>" class="postimg avatar"></button>
                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        <li role="presentation"><?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation"><a href="index.php">Timeline </a></li>
                        <li role="presentation"><a href="messages.php">Messages </a></li>
                        <li class="active" role="presentation"><a href="notify.php">Notifications </a></li>
                        <li role="presentation"><a href="my_account.php">Account Managment</a></li>
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
                           <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#"><?php echo $user[0]['username']?> 
                            <span class="caret"></span>
                             <img src="" data-tempsrc="<?php echo $user[0]['profileimg']?>" class="postimg avatar"></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="index.php">Timeline </a></li>
                                <li role="presentation"><a href="messages.php">Messages </a></li>
                                <li class="active" role="presentation"><a href="notify.php">Notifications </a></li>
                                <li role="presentation"><a href="my_account.php">Account Managment</a></li>
                                <li role="presentation"><a href="change_password.php">Password change</a></li>
                                <li role="presentation"><a href="logout.php">Logout </a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                        <li  role="presentation"><a href="index.php">Timeline</a></li>
                        <li role="presentation"><a href="messages.php">Messages</a></li>
                        <li class="active" role="presentation"><a href="notify.php">Notifications</a></li>
                           <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#"><?php echo $user[0]['username']?> 
                            <span class="caret"></span>
                             <img src="" data-tempsrc="<?php echo $user[0]['profileimg']?>" class="postimg avatar"></a>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <li role="presentation"><?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                                <li class="divider" role="presentation"></li>
                                <li role="presentation"><a href="index.php">Timeline </a></li>
                                <li role="presentation"><a href="messages.php">Messages </a></li>
                                <li class="active" role="presentation"><a href="notify.php">Notifications </a></li>
                                <li role="presentation"><a href="my_account.php">Account Managment</a></li>
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
            <? echo "<h1>Notifcations</h1>";
                if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid))) {
                        $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC', array(':userid'=>$userid));
                        foreach($notifications as $n) {
                                if ($n['type'] == 1) {
                                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
                                        if ($n['extra'] == "") {
                                                echo "You got a notification!<hr />";
                                        } else {
                                                $extra = json_decode($n['extra']);
                                                echo $senderName." mentioned you in a post! - ".$extra->postbody."<hr />";
                                        }
                                } else if ($n['type'] == 2) {
                                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
                                        echo $senderName." liked your post!<hr />";
                                }
                        }
                }
            ?>
        </div>
    </div>

    <div class="footer-dark navbar-fixed-bottom" >
        <footer>
            <div class="container">
                <p class="copyright">Valerijs Diks© 2017/2018</p>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/searchbox.js"></script>
    <script src="assets/js/pictureRender.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>