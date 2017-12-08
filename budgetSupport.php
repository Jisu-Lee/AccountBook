<?php
echo "help";
$host = 'localhost';
$user = 'root';
$pw = 'root';
$dbName = 'account_book';
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$db = new PDO('mysql:host=localhost;dbname=account_book', $user, $pw, $pdo_options);

$stmt = $db->prepare("INSERT INTO budget (userID, startDate, endDate, amount) VALUES (:userID, :startDate, :endDate, :amount)");
$stmt->bindParam(':userID',$userID);
$stmt->bindParam(':startDate',$startDate);
$stmt->bindParam(':endDate',$endDate);
$stmt->bindParam(':amount',$amount);

$userID = $_COOKIE["ID"];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$amount = $_POST['amount'];


$stmt->execute();
echo "New records created successfully";
header("Location: main.php");


?>
