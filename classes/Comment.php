<?php
class Comment {
        public static function createComment($commentBody, $postId, $userId) {
              if (!DB::query('SELECT id FROM posts WHERE id=:postid', array(':postid'=>$postId))) {
                        echo 'Invalid post ID';
                } else {
                        DB::query('INSERT INTO comments VALUES (null, :comment, :userid, NOW(), :postid)', array(':comment'=>$commentBody, ':userid'=>$userId, ':postid'=>$postId));
                }
        }
    
    public static function displayComments($postId){
        $comments= DB::query('SELECT comments.comment,users.username FROM users,comments WHERE post_id=:postid AND comments.user_id=users.id', array(':postid'=>$postId));
        foreach($comments as $comment){
            echo $comment['comment']." ~ ".$comment['username']."<hr/>";
        }
    }
}
?>