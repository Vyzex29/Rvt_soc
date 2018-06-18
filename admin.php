<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (!Login::isLoggedIn()) {
    header('Location: login.html');
    die;
}else{
    $user = DB::query('SELECT username, profileimg FROM users WHERE id=:userid', array(':userid'=>Login::isLoggedIn()));
    $allUsers = DB::query('SELECT username, profileimg FROM users');
    $LastPost = DB::query('SELECT *,count(*) as count FROM `posts` ORDER BY `posted_at`DESC LIMIT 1')[0];
    $NewestPost = DB::query('SELECT * FROM `posts` ORDER BY `posted_at` LIMIT 1')[0];
    $Comment = DB::query('SELECT *, count(*) as count FROM `comments` ORDER BY `posted_at`DESC LIMIT 1')[0];
    $LatestUser = DB::query('SELECT * FROM `users` ORDER BY `id`  DESC LIMIT 1')[0];
    $UserCount = DB::query('SELECT count(*) FROM `users`')[0];
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
                            <li role="presentation">
                                <?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                            <li class="divider" role="presentation"></li>
                            <li class="active" role="presentation"><a href="index.php">Timeline </a></li>
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
                            <li class="dropdown open">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">
                                    <?php echo $user[0]['username']?>
                                    <span class="caret"></span>
                                    <img src="" data-tempsrc="<?php echo $user[0]['profileimg']?>" class="postimg avatar"></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation">
                                        <?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li class="active" role="presentation"><a href="index.php">Timeline </a></li>
                                    <li role="presentation"><a href="messages.php">Messages </a></li>
                                    <li role="presentation"><a href="notify.php">Notifications </a></li>
                                    <li role="presentation"><a href="my_account.php">Account Managment</a></li>
                                    <li role="presentation"><a href="change_password.php">Password change</a></li>
                                    <li role="presentation"><a href="logout.php">Logout </a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav hidden-xs hidden-sm navbar-right">
                            <li class="active" role="presentation"><a href="index.php">Timeline</a></li>
                            <li role="presentation"><a href="messages.php">Messages</a></li>
                            <li role="presentation"><a href="notify.php">Notifications</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">
                                    <?php echo $user[0]['username']?>
                                    <span class="caret"></span> <img src="" data-tempsrc="<?php echo $user[0]['profileimg']?>" class="postimg avatar"></a>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li role="presentation">
                                        <?php echo '<a href="profile.php?username='.$user[0]['username'].'">My Profile</a>'?></li>
                                    <li class="divider" role="presentation"></li>
                                    <li class="active" role="presentation"><a href="index.php">Timeline </a></li>
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
        <div class="container">
            <h1>Administrator panel </h1>
            <div class="col-md-3">
                <h2 class="text-center">User roles</h2>
                <ul class="list-group" id="users">
                    <?php
                foreach ($allUsers as $userArr) {
                    echo '<li class="list-group-item" style="background-color:#FFF;"><span style="font-size:16px;"><strong>'.$userArr['username'].'</strong></span>
                    <img src="" data-tempsrc="'.$userArr['profileimg'].'" class="postimg avatar"></li> ';
                    
                    echo '      
                    <select class="form-control" id="sel1">
                        <option>Administrator</option>
                        <option selected="selected">User</option>
                      </select> 
                    <button type="button" class="btn btn-success btn-block">Change</button>
                    <button type="button" class="btn btn-danger btn-block">Remove</button>';
                  
                }
                ?>
                </ul>
            </div>
            <div class="timelineposts col-md-9">
                <h2 class="text-center">Statistics</h2>
                <div>
                    <div class="media border p-3">
                        <h3 class="text-center">Posts</h3>
                        <div class="media-body">
                            <div class="col-md-4">
                               <?php echo "<h4>Total Count : <small><b>".$LastPost['count']." </b></small></h4>";?>
                            </div>
                            <div class="col-md-4">
                                <?php echo "<h4>Most popular:<small><a href='post.php?id=".$LastPost['id']."'><b>".$LastPost['body']."</b><br></a><i>Posted on ".$LastPost['posted_at']."</i></small></h4>" ?>
                            
                            </div>
                            <div class="col-md-4">
                                <?php echo "<h4>Newest:<small><a href='post.php?id=".$NewestPost['id']."'><b>".$NewestPost['body']."</b><br></a><i>Posted on ".$NewestPost['posted_at']."</i></small></h4>" ?>
                            </div>
                            <button type="button" class="btn btn-success btn-block">Export to pdf</button>
                        </div>

                    </div>
                </div>
                <div>
                    <div class="media border p-3">
                        <h3 class="text-center">Comments</h3>
                        <div class="media-body">
                            <div class="col-md-6">
                                <?php echo "<h4>Total Count : <small><b>".$Comment['count']." </b></small></h4>";?>
                            </div>
                            <div class="col-md-6">
                                   <?php echo "<h4>Most popular:<small><a href='post.php?id=".$Comment['post_id']."'><b>".$Comment['comment']."</b><br></a><i>Posted on ".$LastPost['posted_at']."</i></small></h4>" ?>
                            </div>
                            <button type="button" class="btn btn-success btn-block">Export to pdf</button>
                        </div>

                    </div>
                </div>
                <div>
                    
                    <div class="media border p-3">
                        <h3 class="text-center">Users</h3>
                        <div class="media-body">
                            <div class="col-md-6">
                                <?php echo "<h4>Total Count : <small><b>".$UserCount[0]." </b></small></h4>";?>
                            </div>
                            <div class="col-md-6">
                                <?php echo "<h4>Latest joiner: <small><a href='profile.php?username=".$LatestUser['username']."'><b>".$LatestUser['username']."</b><br></a></small></h4>"?>
                            </div>

                            <button type="button" class="btn btn-success btn-block">Export to pdf</button>
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success btn-block">Export everything to pdf</button>
                </div>
            </div>

        </div>
        <div class="footer-dark navbar-bottom" style="position:relative">
            <footer>
                <div class="container">
                    <p class="copyright">Valerijs Diks© 2017/2018</p>
                </div>
            </footer>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/bs-animation.js"></script>
        <script src="assets/js/searchbox.js"></script>
        <script src="assets/js/pictureRender.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>

    </body>

    </html>
