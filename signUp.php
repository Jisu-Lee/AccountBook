<!DOCTYPE html>
<html>
    <head>
        <title>회원가입 페이지</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="mainstyle.css" />
        <link rel="stylesheet" href="modalstyle.css" />
        <script type="text/javascript" src="login.js"></script>


    </head>
    <body>
      <div class="frame">
        <div class="header">
          <div class="logo"> 가계부 티끌모아 </div>
        </div>

        <div style="text-align: center;">
          <p>
            회원 가입을 위해 폼을 입력해 주세요.
          </p>
          <p>
            <form onsubmit="return checkPW();" action="./LSsupport.php?mode=signUp" method="POST">
              <p>ID : <input type="text" name="ID" required></p>
              <p>Password : <input type="password" name="password" id="password" required></p>
              <p>Password_re : <input type="password" name="password_re" id="password_re" required></p>
              <p>Name : <input type="text" name="name" required></p>
              <input type="submit" value="Sign Up"/>
            </form>

          </p>
        </div>
        <div class="footer">
          <p class="copyright">&copy;영은지수 </p>
         </div>




      </div>



  </body>
</html>
