<?php
echo "help";
$host = 'localhost';
$user = 'root';
$pw = 'root';
$dbName = 'account_book';
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$db = new PDO('mysql:host=localhost;dbname=account_book', $user, $pw, $pdo_options);

switch($_GET['mode']){
    case 'signUp':

      echo "why";
      $stmt = $db->prepare("INSERT INTO member (ID, password, name) VALUES (:ID, :password, :name)");
      $stmt->bindParam(':ID',$ID);
      $stmt->bindParam(':password',$password);
      $stmt->bindParam(':name',$name);

      $ID = $_POST['ID'];
      $password = $_POST['password'];
      $name = $_POST['name'];

      $stmt->execute();
      echo "New records created successfully";
      header("Location: mainLogin.php");
      break;


      case 'signIn':

            #$get = $db->prepare("SELECT * FROM user");
            #$get->execute();
            #print_r($get->fetch());
            $stmt = $db->prepare("SELECT * FROM member WHERE ID=:ID AND password=:password");
            $ID = $_POST['ID'];
            $password = $_POST['password'];
            echo $ID;
            #$Name = $_POST['name'];
            $stmt->bindParam(':ID',$ID);
            $stmt->bindParam(':password',$password);
            #$stmt->bindParam(':Name',$Name);

            #print_r($stmt->fetch());
            $result = $stmt->execute();



            if($stmt->rowCount()>0){
       foreach ($stmt as $row) :
         if($row[0] == $ID){
           if($row[1] == $password){
             echo $row[2];
             echo" wellcome";
             setcookie("ID", $_POST["ID"], time() + 3600);
		         setcookie("password", $_POST["password"], time() + 3600);
             setcookie("name", $row[2], time() + 3600);
             header("Location: main.php");
           }
         }
       endforeach;
     }
     else {
       echo "no...";
       echo "<script>alert(\"로그인에 실패하셨습니다.\");</script>";
       ?><p> <a href = "mainLogin.php">돌아가기</a></p>
       <p>아직 회원이 아니신가요? <a href = "signUp.php">회원가입</a></p><?php
       #header("Location: mainLogin.php");
     }

            break;
      case 'signOut':
        if (isset($_COOKIE["ID"]) || isset($_COOKIE["password"]))
          {
            // 쿠키 지우기: setcookie("변수명", ""(빈 문자열), 과거 시점);
            setcookie("ID", "", time() - 3600);
            setcookie("password", "", time() - 3600);
            setcookie("name", "", time() - 3600);
            $valid_logout = true;
            header("Location: main.php");
          }
          else
          {
            $valid_logout = false;
          }
      break;



}
?>