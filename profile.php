<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('./classes/Comment.php');
$username = "";
$verified = False;
$isFollowing = False;
if (isset($_GET['username'])) {
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {

                $username = DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['username'];
                $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
                $verified = DB::query('SELECT verified FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['verified'];
                $followerid = Login::isLoggedIn();

                if (isset($_POST['follow'])) {

                        if ($userid != $followerid) {
                            
                                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        if ($followerid == 6) {
                                                DB::query('UPDATE users SET verified=1 WHERE id=:userid', array(':userid'=>$userid));
                                        }
                                        DB::query('INSERT INTO followers VALUES (null, :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                                } else {
                                        echo 'Already following!';
                                }
                                $isFollowing = True;
                        }
                }
                if (isset($_POST['unfollow'])) {

                        if ($userid != $followerid) {

                                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        if ($followerid == 6) {
                                                DB::query('UPDATE users SET verified=0 WHERE id=:userid', array(':userid'=>$userid));
                                        }
                                        DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                                }
                                $isFollowing = False;
                        }
                }
                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                        $isFollowing = True;
                }

                if (isset($_POST['deletepost'])) {
                        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
                                DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
                                DB::query('DELETE FROM posts_likes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
                        }
                }
                if (isset($_POST['post'])) {
                    $str = str_replace(array("\r\n", "\n", "\r"), ' ', $_POST['postbody']);
                        if ($_FILES['postimg']['size'] == 0) {                            
                                Post::createPost($str, Login::isLoggedIn(), $userid);
                        } else {
                                $postid = Post::createImgPost($str, Login::isLoggedIn(), $userid);
                                Image::uploadImage('postimg', "UPDATE posts SET postimg=:postimg WHERE id=:postid", array(':postid'=>$postid));
                        }
                }
        } else {
                die('User not found!');
        }
}

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Social Network</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/Footer-Dark.css">
        <link rel="stylesheet" href="assets/css/Highlight-Clean.css">
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
                                <?php echo '<a href="profile.php?username='.$username.'">My Profile</a>'?></li>
                            <li class="divider" role="presentation"></li>
                            <li role="presentation"><a href="index.php">Timeline </a></li>
                            <li role="presentation"><a href="messages.php">Messages </a></li>
                            <li role="presentation"><a href="notify.php">Notifications </a></li>
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
                                        <?php echo '<a href="profile.php?username='.$username.'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
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
                                    <li class="active" role="presentation">
                                        <?php echo '<a href="profile.php?username='.$username.'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
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
            <h1 id="user" class="<?php echo $username?>">
                <?php echo $username; ?>'s Profile
                <?php if ($verified) { echo '<i class="glyphicon glyphicon-ok-sign verified" data-toggle="tooltip" title="Verified User" style="font-size:28px;color:#da052b;"></i>'; } ?></h1>
        </div>
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <li class="list-group-item"><span><strong>About Me</strong></span>
                                <p>Welcome to my profile bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;bla bla&nbsp;</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <div class="timelineposts">
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <?php
                    if ($userid != $followerid) {
                       echo ' <form action="profile.php?username='.$username.'" method="post">';
                            if ($isFollowing) {
                                echo '<input type="submit" name="unfollow" value="Unfollow" style="width:100%;background-image:url(&quot;none&quot;);background-color:#316808;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">';
                            } else {
                                echo '<input type="submit" name="follow" value="Follow" style="width:100%;background-image:url(&quot;none&quot;);background-color:#316808;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">';
                            }
                        echo '</form>';
                    }else  {       
                       echo '<button class="btn btn-default" type="button" style="width:100%;background-image:url(&quot;none&quot;);background-color:#316808;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;" onclick="showNewPostModal()">NEW POST</button>
                        <ul class="list-group"></ul>';
                    }
                 ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="commentsmodal" role="dialog" tabindex="-1" style="padding-top:100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <h4 class="modal-title">Comments</h4>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow-y: auto">
                        <p>The content of your modal.</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="newpost" role="dialog" tabindex="-1" style="padding-top:100px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                        <h4 class="modal-title">New Post</h4>
                    </div>
                    <form action="profile.php?username=<?php echo $username; ?>" method="post" enctype="multipart/form-data">
                        <div style="max-height: 400px; overflow-y: auto">

                            <textarea name="postbody" rows="8" cols="80"></textarea>
                            <br />Upload an image:
                            <input type="file" name="postimg">

                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="post" value="Post" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#316808;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">
                            <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-dark">
            <footer>
                <div class="container">
                    <p class="copyright">Valerijs Diks @ 2017/2018</p>
                </div>
            </footer>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
        <script src="assets/js/profile.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>

    </body>

    </html>
