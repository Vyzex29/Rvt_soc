<?php
class Post {
                public static function createPost($postbody, $loggedInUserId, $profileUserId) {
                if (strlen($postbody) > 160 || strlen($postbody) < 1) {
                        die('Incorrect length!');
                }
                $topics = self::getTopics($postbody);
                if ($loggedInUserId == $profileUserId) {
                        if (count(self::createNotify($postbody)) != 0) {
                                foreach (self::createNotify($postbody) as $key => $n) {
                                        $s = $loggedInUserId;
                                        $r = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$key))[0]['id'];
                                        if ($r != 0) {
                                                DB::query('INSERT INTO notifications VALUES (null, :type, :receiver, :sender,:extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s,':extra'=>$n["extra"]));
                                        }
                                }
                        }
                        DB::query('INSERT INTO posts VALUES (null, :postbody, NOW(), :userid, 0, null, :topics)', array(':postbody'=>$postbody, ':userid'=>$profileUserId, ':topics'=>$topics));
                } else {
                        die('Incorrect user!');
                }
        }
    
        public static function createImgPost($postbody, $loggedInUserId, $profileUserId) {
                if (strlen($postbody) > 160) {
                        die('Incorrect length!');
                }
            $topics=self::getTopics($postbody);
                if ($loggedInUserId == $profileUserId) {
                      if (count(self::createNotify($postbody)) != 0) {
                                foreach (self::createNotify($postbody) as $key => $n) {
                                        $s = $loggedInUserId;
                                        $r = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$key))[0]['id'];
                                        if ($r != 0) {
                                                DB::query('INSERT INTO notifications VALUES (null, :type, :receiver, :sender,:extra)', array(':type'=>$n["type"], ':receiver'=>$r, ':sender'=>$s,':extra'=>$n["extra"]));
                                        }
                                }
                        }
                        DB::query('INSERT INTO posts VALUES (null, :postbody, NOW(), :userid, 0, null,:topics)', array(':postbody'=>$postbody, ':userid'=>$profileUserId,':topics'=>$topics));
                        $postid = DB::query('SELECT id FROM posts WHERE user_id=:userid ORDER BY ID DESC LIMIT 1;', array(':userid'=>$loggedInUserId))[0]['id'];
                        return $postid;
                } else {
                        die('Incorrect user!');
                }
        }
        public static function likePost($postId, $likerId) {
                if (!DB::query('SELECT user_id FROM posts_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))) {
                        DB::query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
                        DB::query('INSERT INTO posts_likes VALUES (null, :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
                        self::createNotify("",$postId);
                } else {
                        DB::query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
                        DB::query('DELETE FROM posts_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
                }
        }
    
        public static function getTopics($text){
            $text = explode(" ", $text);
            $topics="";
            foreach ($text as $word){
                if (substr($word, 0, 1) == "#"){
                    $topics .=substr($word,1).",";
                }  
            }
            return $topics;
        }
    
    
        public static function link_add($text){
            $text = explode(" ", $text);
            $newstring ="";
            
            foreach ($text as $word){
                if (substr($word, 0, 1) == "@"){ //check for user with @ symbol
                    $newstring .="<a href='profile.php?username=".substr($word, 1)."'>".htmlspecialchars($word)." </a>";
                }else if (substr($word, 0, 1) == "#"){
                    $newstring .="<a href='topics.php?topic=".substr($word, 1)."'>".htmlspecialchars($word)." </a>";
                }else{
                    $newstring.=htmlspecialchars($word)." "; 
                }    
            }
            return $newstring;
        }
        
            public static function createNotify($text = "", $postid = 0) {
                $text = explode(" ", $text);
                $notify = array();
                foreach ($text as $word) {
                        if (substr($word, 0, 1) == "@") {
                                $notify[substr($word, 1)] = array("type"=>1, "extra"=>' { "postbody": "'.htmlentities(implode($text, " ")).'" } ');
                        }
                }
                if (count($text) == 1 && $postid != 0) {
                        $temp = DB::query('SELECT posts.user_id AS receiver, posts_likes.user_id AS sender FROM posts, posts_likes WHERE posts.id = posts_likes.post_id AND posts.id=:postid', array(':postid'=>$postid));
                        $r = $temp[0]["receiver"];
                        $s = $temp[0]["sender"];
                        DB::query('INSERT INTO notifications VALUES (null, :type, :receiver, :sender, :extra)', array(':type'=>2, ':receiver'=>$r, ':sender'=>$s, ':extra'=>""));
                }
                return $notify;
        }
    
        public static function displayPosts($userid, $username, $loggedInUserId) {  //diplays from multiple sql ,depending on user and posts
                $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$userid));
                $posts = "";
                foreach($dbposts as $p) {
                        if (!DB::query('SELECT post_id FROM posts_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$p['id'], ':userid'=>$loggedInUserId))) {
                                $posts .= "<img src='".$p['postimg']."'>"."<br/>".self::link_add($p['body'])."
                                <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
                                        <input type='submit' name='like' value='Like'>
                                        <span>".$p['likes']." likes</span>
                                ";
                                    if ($userid==$loggedInUserId){
                                        $posts .="<input type='submit' name='deletepost' value='x' />";
                                    }
                                $posts .= "
                                </form><hr /></br />
                                ";
                        } else {
                                $posts .= "<img src='".$p['postimg']."'>"."<br/>".self::link_add($p['body'])."
                                <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
                                        <input type='submit' name='unlike' value='Unlike'>
                                        <span>".$p['likes']." likes</span>
                                    ";
                                    if ($userid==$loggedInUserId){
                                            $posts .="<input type='submit' name='deletepost' value='x' />";
                                        }
                                $posts .= "
                                </form><hr /></br />
                                ";
                        }
                }
                return $posts;
        }
}
?>