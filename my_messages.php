<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
} else {
        die('Not logged in');
}
if (isset($_GET['mid'])) {
        $message = DB::query('SELECT * FROM messages WHERE id=:mid AND (receiver=:receiver OR sender=:sender)', array(':mid'=>$_GET['mid'], ':receiver'=>$userid, ':sender'=>$userid))[0];
        echo '<h1>View Message</h1>';
        echo htmlspecialchars($message['body']);
        echo '<hr />';
        if ($message['sender'] == $userid) {
                $id = $message['receiver'];
        } else {
                $id = $message['sender'];
        }
        DB::query('UPDATE messages SET `is_read`=1 WHERE id=:mid', array (':mid'=>$_GET['mid']));
        ?>
        <form action="send_message.php?receiver=<?php echo $id; ?>" method="post">
                <textarea name="body" rows="8" cols="80"></textarea>
                <input type="submit" name="send" value="Send Message">
        </form>
        <?php
} else {
?>
<h1>My Messages</h1>
<?php
$messages = DB::query('SELECT messages.*, users.username FROM messages, users WHERE receiver=:receiver OR sender=:sender AND users.id = messages.sender', array(':receiver'=>$userid, ':sender'=>$userid));
foreach ($messages as $message) {
        if (strlen($message['body']) > 12) {
                $m = substr($message['body'], 0, 12)." ...";
        } else {
                $m = $message['body'];
        }
        if ($message['is_read'] == 0) {
                echo "<a href='my_messages.php?mid=".$message['id']."'><b>".$m."</b></a> sent by ".$message['username'].'<hr />';
        } else {
                echo "<a href='my_messages.php?mid=".$message['id']."'>".$m."</a> sent by ".$message['username'].'<hr />';
        }
}
}
?>