<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
    </head>
    <body>
      <p>
        회원 가입을 위해 폼을 입력해 주세요.
      </p>
      <p>
        <fieldset>
        <form action="./LSsupport.php?mode=signUp" method="POST">
          ID : <input type="text" name="ID">
          Password : <input type="text" name="password" >
          Name : <input type="text" name="name">
          <input type="submit" value="Sign Up"/>
        </form>
      </fieldset>
    </p>

  </body>
</html>
