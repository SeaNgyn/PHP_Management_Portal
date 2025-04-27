<?php
require 'components/header.php';
echo "<h1>List of feedback here</h1>";
$sql = "SELECT name, email, body from feedback;";
$statement = $connection->prepare($sql);
$statement->execute();
$result = $statement->setFetchMode(PDO::FETCH_ASSOC);
$feedbacks = $statement->fetchAll();
echo '<ul class="list-group">';
foreach($feedbacks as $feedback) {
    $name = $feedback['name'] ?? '';
    $email = $feedback['email'] ?? '';
    $body = $feedback['body'] ?? '';
    echo '<li class="list-group-item">';
    echo "<p>$name</p>";
    echo "<p>$email</p>";
    echo "<p>$body</p>";
    echo "</li>";

}
echo '</ul>';
echo '<a href="index.php">Click here to back Home</a>';
include 'components/footer.php';
?>

