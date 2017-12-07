<?php

echo "여기까지 기본설정"
$host = 'localhost';
$user = 'root';
$pw = 'wnsla786';
$dbName = 'account_book';
echo "여기까지 기본설정"
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$db = new PDO('mysql:host=localhost;dbname=account_book', $user, $pw, $pdo_options);


  $get = $db->prepare("SELECT * FROM transaction");
  $get->execute();
print_r($get->fetch());

/*
switch($_GET['mode']){
  case 'insert_trans':
    $get = $db->prepare("SELECT * FROM transaction");
    $get->execute();
    print_r($get->fetch());
    # transaction(transID, userID, amount, category, date, detail)

    echo "insert transactions";

    $stmt = $db->prepare("INSERT INTO
      transaction (transID, userID, amount, category, date_, detail)
      VALUES (:transID, :userID, :amount, :category, :date_, :detail) ");
    $stmt->bindParam(':transID', $transID);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':date_', $date);
    $stmt->bindParam(':detail', $detail);
echo"2";echo " ";
    $transID = '1001';
    $userID = '2014';
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $detail = $_POST['detail'];

    echo $transID;
    echo $userID;
    echo $amount;
    echo $date;
    echo $category;
    echo $detail;

echo"1";
    $stmt->execute();
    //print_r($stmt->errorInfo());
    echo "records inserted successfully";
    header("Location: action.php");
    break;

}
*/
?>
