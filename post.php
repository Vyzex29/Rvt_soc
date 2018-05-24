<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Notify.php');
include('./classes/Comment.php');
$userId=Login::isLoggedIn();
if (!$userId) {
    header('Location: login.html');
    die;
}else{
$username = DB::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()))[0]['username'];
     if (isset($_GET['id'])) {
                $postId=$_GET['id'];
        $post = DB::query('SELECT posts.id, posts.body, posts.posted_at, posts.postimg, posts.likes, users.`username` FROM users, posts
                WHERE users.id = posts.user_id
                AND posts.id=:postid', array(':postid'=>$postId));
        $comments=DB::query('SELECT comments.comment, users.username FROM comments, users WHERE post_id = :postid AND comments.user_id = users.id', array(':postid'=>$postId));
           if (!$post) {                
              die('Post not found!');
            }
        if ($_SERVER['REQUEST_METHOD']=='POST')
        {   
             if (isset($_POST['post'])) {
                    $str = str_replace(array("\r\n", "\n", "\r"), ' ', htmlentities($_POST['postbody']));
                    Comment::createComment($str, $postId, $userId);  
                }
                 
        }
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
                            <li class="dropdown open"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">User <span class="caret"></span></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation">
                                        <?php echo '<a href="profile.php?username='.$username.'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
                                    <li role="presentation"><a href="my_account.php">Account Managment</a></li>
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
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <div class="timelineposts">
                                <?php    
                                echo "<li class='list-group-item' id='".$post[0]['id']."'><blockquote><p>".$post[0]['body']."</p>";
                                if ($post[0]['postimg']!=""){
                                    echo "<img data-tempsrc='".$post[0]['postimg']."' class='postimg'>";
                                }
                                echo "<footer>Posted by '".$post[0]['username']."' on ".$post[0]['posted_at'];
                                echo "<button class='btn btn-default' type='button' style='color:#eb3b60;background-image:url(&quot;none&quot;);background-color:transparent;' data-id=".$post[0]['id']."> <span class='glyphicon glyphicon-heart' ></span> ".$post[0]['likes']." Likes</span></button></footer>"   
                                ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <textarea name="postbody" rows="8" cols="70" required></textarea>
                                    <input type="submit" name="post" value="Comment" class="btn btn-default" type="button" style="background-image:url(&quot;none&quot;);background-color:#316808;color:#fff;padding:16px 32px;margin:0px 0px 6px;border:none;box-shadow:none;text-shadow:none;opacity:0.9;text-transform:uppercase;font-weight:bold;font-size:13px;letter-spacing:0.4px;line-height:1;outline:none;">
                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                </form>
                                <?php
                                    echo "</blockquote></li>";
                                ?>
                                    <li class='list-group-item'>
                                        <blockquote>
                                            <p>
                                                <?php 
                                            if (!empty($comments)){
                                                foreach ($comments as $comment){
                                                    echo $comment['comment']." ~ ".$comment['username'];
                                                    echo "<hr />";
                                                }
                                            }  
                                        ?>
                                            </p>
                                        </blockquote>
                                    </li>
                            </div>
                        </ul>
                    </div>
                    <div class="col-md-2">
                    </div>
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
    </body>

    </html>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="assets/js/post.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
