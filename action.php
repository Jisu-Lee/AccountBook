<?php
try{

  $host = 'localhost';
  $user = 'root';
  $pw = 'root';
  $dbName = 'account_book';
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
  $connect = new PDO('mysql:host=localhost;dbname=account_book;charset=utf8;', $user, $pw, $pdo_options);
  
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die('Error connecting to database');
}


switch($_GET['mode']){
  case 'insert_trans':

    # transaction(transID, userID, amount, category, date, detail)
    $stmt = $connect->prepare("INSERT INTO transaction (transID, userID, amount, category, date_, detail) VALUES (:transID, :userID, :amount, :category, :date_, :detail) ");
    $stmt->bindParam(':transID', $transID);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':date_', $date);
    $stmt->bindParam(':detail', $detail);

    $cnt = $connect->prepare("SELECT count(*) FROM transaction");
    $cnt->execute();
    $num = $cnt->fetchColumn();
    $num = $num + 1;

    $transID = (string)$num;
    $userID = $_COOKIE["ID"];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $detail = $_POST['detail'];

echo $transID;
echo $userID;
echo $amount;
echo $category;
echo $date;
echo $detail;

    $stmt->execute();
    print_r($stmt->errorInfo());
    echo "records inserted successfully";
    header("Location: main.php");
    break;

}
?>
