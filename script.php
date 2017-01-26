<?php

echo "test";

$mysql = mysql_connect("localhost","root","TitkosJelszo");

if (!$mysql) {
	die(mysql_error());
}

mysql_select_db("wordpress",$mysql);

$sql = "SELECT * FROM wp_posts WHERE post_status='publish' AND post_type='post' LIMIT 1";

$result = mysql_query($sql,$mysql);

while ($row = mysql_fetch_assoc($result)) {
print_r($row);
$id = $row["ID"];
}

$date = date("Y-m-d H:i:s");

echo "<br>".$date."<br>";

$sql2 = "UPDATE wp_posts SET post_modified='$date' WHERE ID=$id";

$res2 = mysql_query($sql2,$mysql);

if (!$res2) {
	die(mysql_error());
}

$sql3 = "INSERT INTO wp_comments (comment_ID, comment_post_ID, comment_author, comment_author_email, comment_author_url, comment_author_IP, comment_date, comment_date_gmt, comment_content, comment_karma, comment_approved, comment_agent, comment_type, comment_parent, user_id) VALUES ('',$id,'NagyDaniel','nd@ndaniel.hu','ndaniel.hu','127.0.0.1','$date','$date','Nagyon jó cikk','0','1','','','0','0')";

$res3 = mysql_query($sql3,$mysql);

if (!$res3) {
        die(mysql_error());
}

mysql_close($mysql);


?>

