
<!DOCTYPE html>
<? if (!isset($_COOKIE["ID"]) || !isset($_COOKIE["password"])) { ?>
		<p style="text-align: center;">로그인되지 않았습니다.</p>
		<?header("Location: mainLogin.php");
	 } else { ?>
		<p style="text-align: center;">환영합니다. <?=$_COOKIE["name"]?>님</p>
		<? } ?>
<html>
  <head>
      <title>가계부</title>
        <link rel="stylesheet" href="mainstyle.css" />
        <link rel="stylesheet" href="modalstyle.css" />
  </head>
<body>
  <div class="frame">
    <div class="header">
      <div class="logo"> 가계부 티끌모아 </div>
    </div>
    <!-- //header -->
    <div class="container">
      <div class="nav">
        <ul class="nav-list">
          <li class="nav-item"> <a href="main.php" class="nav-link">메인</a> </li>
          <li class="nav-item"> <a href="./statistics.php" class="nav-link">통계</a> </li>
          <li class="nav-item"> <a href="./userData.php" class="nav-link">회원정보</a> </li>

<? if (!isset($_COOKIE["ID"]) || !isset($_COOKIE["password"])) { ?>
          <li class="nav-item"> <a href="./mainLogin.php" class="nav-link">로그인</a> </li>
          <? } else { ?>
            <li class="nav-item"> <a href="./LSsupport.php?mode=signOut" class="nav-link">로그아웃</a> </li>
            <? } ?>

        </ul>
      </div>
      <!-- //nav -->





      <?php
          $host = 'localhost';
          $user = 'root';
          $pw = 'root';
          $dbName = 'account_book';
          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          $db = new PDO('mysql:host=localhost;dbname=account_book;charset=utf8;', $user, $pw, $pdo_options);

          $get = $db->prepare("SELECT transID, date_, category, amount, detail FROM transaction WHERE userID=:userID");
          $ID = $_COOKIE['ID'];
          $get->bindParam(':userID',$ID);
          $get->execute();

          $get_ = $db->prepare("SELECT transID, date_, category, amount, detail FROM transaction WHERE userID=:userID");
          $get_->bindParam(':userID',$ID);
          $get_->execute();

          $get__ = $db->prepare("SELECT startDate, endDate, amount FROM budget WHERE userID=:userID");
          $get__->bindParam(':userID',$ID);
          $get__->execute();

          $index_ex = 1;
          $index_in = 1;
          $index_budget = 1;

          ?>


          <table style="float:left;" class="statistics">
            <caption>지출 금액</caption>
               <tr>
                 <th style="width:40px;">번호</th>
                 <th style="width:90px;">날짜</th>
                 <th style="width:70px;">카테고리</th>
                 <th style="width:50px;">금액</th>
                 <th style="width:70px;">세부사항</th>
               </tr>
               <? foreach ($get as $row) : ?>
               <tr><?if(strcmp(substr($row[2], 0, 2), 'ex') == 0){?>
                 <td><? echo $index_ex++; ?></td>
                 <td><? echo $row[1]; ?></td>
                 <td><? if(strcmp($row[2],"ex:food")==0){echo "음식";}
                 else if(strcmp($row[2],"ex:clothing")==0){echo "의류";}
                 else if(strcmp($row[2],"ex:culture")==0){echo "문화생활";}
                 else if(strcmp($row[2],"ex:necessity")==0){echo "생필품";}
                 else if(strcmp($row[2],"ex:event")==0){echo "경조사";}
                 else if(strcmp($row[2],"ex:saving")==0){echo "적금";}
                 else {echo "기타";} ?></td>
                 <td><? echo $row[3]; ?></td>
                 <td><? echo $row[4]; ?></td>
               </tr><?}?>
               <? endforeach; ?>
             </table>

             <table style="float:left;margin-left:10px;" class="statistics">
               <caption>수입 금액</caption>
                  <tr>
                    <th style="width:40px;">번호</th>
                    <th style="width:90px;">날짜</th>
                    <th style="width:70px;">카테고리</th>
                    <th style="width:50px;">금액</th>
                    <th style="width:70px;">세부사항</th>
                  </tr>
                  <? foreach ($get_ as $row) : ?>
                  <tr><?if(strcmp(substr($row[2], 0, 2), 'in') == 0){?>
                    <td><? echo $index_in++; ?></td>
                    <td><? echo $row[1]; ?></td>
                    <td><? if(strcmp($row[2],"in:pay")==0){echo "월급";}
                    else if(strcmp($row[2],"in:allowance")==0){echo "용돈";}
                    else if(strcmp($row[2],"in:parttime")==0){echo "아르바이트";}
                    else if(strcmp($row[2],"in:bonus")==0){echo "보너스";}
                    else {echo "기타";} ?></td>
                    <td><? echo $row[3]; ?></td>
                    <td><? echo $row[4]; ?></td>
                  </tr><?}?>
                  <? endforeach; ?>
                </table>

                <table style="float:left;margin-left:10px;"  class="statistics">
                  <caption>예산 계획</caption>
                     <tr>
                       <th style="width:40px;">번호</th>
                       <th style="width:90px;">시작 날짜</th>
                       <th style="width:90px;">종료 날짜</th>
                       <th style="width:60px;">예산 금액</th>

                     </tr>
                     <? foreach ($get__ as $row) : ?>
                     <tr>
                       <td><? echo $index_budget++; ?></td>
                       <td><? echo $row[0]; ?></td>
                       <td><? echo $row[1]; ?></td>
                       <td><? echo $row[2]; ?></td>

                     </tr>
                     <? endforeach; ?>
                   </table>






  </div>
    <!-- //container -->
    <div class="footer">
      <p class="copyright">&copy;영은지수 </p>
     </div>
  </div>
  <!-- //footer -->

  </div>
<!-- //modal -->
<script type="text/javascript" src="mainscript.js"></script>
</body>
<!-- //frame -->
</html>
