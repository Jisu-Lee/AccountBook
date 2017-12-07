<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>

      <p>
        <form action="./LSsupport.php?mode=signIn" method="POST">
          ID : <input type="text" name="ID">
          Password : <input type="text" name="password" >
          <input type="submit" value="login"/>
        </form>
    </p>
    <p>아직 회원이 아니신가요? <a href = "signUp.php">회원가입</a></p>

  </body>
</html>


  <?php
      $host = 'localhost';
      $user = 'root';
      $pw = 'root';
      $dbName = 'account_book';
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $db = new PDO('mysql:host=localhost;dbname=account_book', $user, $pw, $pdo_options);

      $get = $db->prepare("SELECT * FROM member");
      $get->execute();

      ?>

      <table border = "1">
           <tr>
             <th>ID</th>
             <th>password</th>
             <th>name</th>
           </tr>
           <? foreach ($get as $row) : ?>
           <tr>
             <td><? echo $row[0]; ?></td>
             <td><? echo $row[1]; ?></td>
             <td><? echo $row[2]; ?></td>
           </tr>
           <? endforeach; ?>
         </table>
</br>
