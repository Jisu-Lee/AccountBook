<!DOCTYPE html>
<html>
    <head>
        <title>로그인 페이지</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="mainstyle.css" />
        <link rel="stylesheet" href="modalstyle.css" />
    </head>
    <body>

      <div class="frame">
        <div class="header">
          <div class="logo"> 가계부 티끌모아 </div>
        </div>

        <div style="text-align: center;">
        <p>
            <form action="./LSsupport.php?mode=signIn" method="POST">
              ID : <input type="text" name="ID" required>
              Password : <input type="password" name="password" required>
              <input type="submit" value="login"/>
            </form>
        </p><br>
        <p>아직 회원이 아니신가요? <a href = "signUp.php">회원가입</a></p>
        </div>
        <div class="footer">
        <p class="copyright">&copy;영은지수 </p>
        </div>

      </div>

  </body>
</html>
