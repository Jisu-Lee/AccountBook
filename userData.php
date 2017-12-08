<?php
$host = 'localhost';
$user = 'root';
$pw = 'root';
$dbName = 'account_book';
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$db = new PDO('mysql:host=localhost;dbname=account_book;charset=utf8;', $user, $pw, $pdo_options);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>회원정보 페이지</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="mainstyle.css" />
        <link rel="stylesheet" href="modalstyle.css" />
        <script type="text/javascript" src="mainscript.js"></script>


    </head>
    <body>
      <div class="frame">
        <div class="header">
          <div class="logo"> 가계부 티끌모아 </div>
        </div>

        <div style="text-align: center;">
          <p>
            회원 정보
          </p>
          <p style="text-align: center;">이름: <?=$_COOKIE["name"]?></p>
          <p style="text-align: center;">ID: <?=$_COOKIE["ID"]?></p>
          <div class="content_header">

            <div  style="display:inline-block">
              <button type="button" id="budgetBtn" onclick="hide_and_show_func()">정보 변경</button>
            </div>
            <div id="hide_and_show_budget" style="display:none">
  						<form action="./LSsupport.php?mode=modify" method="POST">
                <p>변경할 비밀번호 : <input type="password" name="password" id="password" required></p>
                <p>비밀번호 재입력 : <input type="password" name="password_re" id="password_re" required></p>
                <p>Name : <input type="text" name="name" required></p>
              <input type="submit" value="Save"/>
  						</form>
            </div>

        </div>
        <div class="footer">
          <p class="copyright">&copy;영은지수 </p>
         </div>




      </div>



  </body>
</html>


<?



switch($_GET['mode']){
    case 'signUp':

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

       echo "<script>alert(\"로그인에 실패하셨습니다.\");window.location.href='mainLogin.php';</script>";

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
