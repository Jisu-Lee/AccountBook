<?php
$year = (int)date("Y");
$month = (int)date("m");
$today = (int)date("d");

$weekday = (int)date("w");
$weekly_income[6] = 0;
$weekly_outcome[6] = 0;
$first_saturday = ($today % 7) + (6 - $weekday);


$host = 'localhost';
$user = 'root';
$pw = 'root';
$dbName = 'account_book';
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$db = new PDO('mysql:host=localhost;dbname=account_book;charset=utf8;', $user, $pw, $pdo_options);

$stmt = $db->prepare("SELECT amount, category, date_ FROM transaction WHERE userID=:ID");
$ID = $_COOKIE['ID'];
$stmt->bindParam(':ID',$ID);
$result = $stmt->execute();

$monthly_income = 0;
$monthly_outcome = 0;

if($stmt->rowCount()>0){
foreach ($stmt as $row) :


	if(strcmp(substr($row[1], 0, 2), 'ex') == 0){
		$monthly_outcome += (int)($row[0]);

		if(strtotime($year*10000+$month*100+1) <= strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday) >= strtotime($row[2])){
			$weekly_outcome[0] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+7) >= strtotime($row[2])){
			$weekly_outcome[1] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+7) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*2)) >= strtotime($row[2])){
			$weekly_outcome[2] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+(7*2)) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*3)) >= strtotime($row[2])){
			$weekly_outcome[3] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+(7*3)) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*4)) >= strtotime($row[2])){
			$weekly_outcome[4] += (int)($row[0]);
		}


	}
	else 	if(strcmp(substr($row[1], 0, 2), 'in') == 0){
		$monthly_income += (int)($row[0]);

		if(strtotime($year*10000+$month*100+1) <= strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday) >= strtotime($row[2])){
			$weekly_income[0] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+7) >= strtotime($row[2])){
			$weekly_income[1] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+7) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*2)) >= strtotime($row[2])){
			$weekly_income[2] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+(7*2)) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*3)) >= strtotime($row[2])){
			$weekly_income[3] += (int)($row[0]);
		}
		else if(strtotime($year*10000+$month*100+$first_saturday+(7*3)) < strtotime($row[2]) && strtotime($year*10000+$month*100+$first_saturday+(7*4)) >= strtotime($row[2])){
			$weekly_income[4] += (int)($row[0]);
		}
	}
endforeach;
}
else {


#header("Location: mainLogin.php");
}



?>


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
          <li class="nav-item"> <a href="./main.php" class="nav-link">메인</a> </li>
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
      <div class="content">
        <div class="content_header">

<div  style="display:inline-block">
            <button type="button" class="budgetbtn" id="budgetBtn" onclick="hide_and_show_func()">예산<br/>설정</button>
          </div>
          <div id="hide_and_show_budget" style="display:none">
						<form action="./budgetSupport.php" method="POST">
	            Start : <input type="date" size="5"name="startDate" required>
	            End : <input type="date" size="5" name="endDate" required>
	            amount : <input type="number" size="3" name="amount" min="1000">
            <input type="submit" value="Save"/>
						</form>
          </div>

          <table class="budget">
            <thead>
              <tr>
                <th>월수입</th>
                <th>월지출</th>
                <th>잔액</th>
              </tr>
            </thead>
            <tr>
              <td> <? echo $monthly_income; ?> </td>
              <td> <? echo $monthly_outcome; ?> </td>
              <td> <? echo $monthly_income - $monthly_outcome; ?> </td>
            </tr>
        </table>
      </div>
			<?php include 'calendar.php'; ?>
      <table class="week_total">
        <thead> <tr> <th> 주간잔액 </th> </tr></thead>
        <tbody>
        <tr><td> <? echo $weekly_income[0] - $weekly_outcome[0]; ?> </td></tr>
        <tr><td> <? echo $weekly_income[1] - $weekly_outcome[1]; ?> </td></tr>
        <tr><td> <? echo $weekly_income[2] - $weekly_outcome[2]; ?> </td></tr>
        <tr><td> <? echo $weekly_income[3] - $weekly_outcome[3]; ?> </td></tr>
        <tr><td> <? echo $weekly_income[4] - $weekly_outcome[4]; ?> </td></tr>
      </tbody>
      </table>
    </div>
  </div>
    <!-- //container -->
    <div class="footer">
      <p class="copyright">&copy;영은지수 </p>
     </div>
  </div>
  <!-- //footer -->
  <div id="myModal" class="modal">
      <div class="modal_content">
        <div class="modal_header">
          수입/지출 추가
          <span class="close">&times;</span>
        </div>
        <div class="modal_body">
        <form action="./action.php?mode=insert_trans" method="POST">
          <div class="modal_date">
              날짜<br>
              <input type="text" id="date" name="date" readonly />
          </div>
          <div class="modal_detail">
              상세내역<br>
              <input type="text" id="detail" name="detail" required />
          </div>
          <div class="modal_price">
              금액<br>
              <input type="number" id="price" name="amount" min="1" required />
          </div>
          <div class="modal_category">
              카테고리<br>
              <input type="text" id="category" name="category" value="ex:food" readonly />
              <div class="expense">
                  지출<br>
                  <button type="button" value="ex:food" onclick="setCategory(this.value)">음식</button>
                  <button type="button" value="ex:clothing" onclick="setCategory(this.value)">의류</button>
                  <button type="button" value="ex:culture" onclick="setCategory(this.value)">문화생활</button>
                  <button type="button" value="ex:necessity" onclick="setCategory(this.value)">생필품</button>
                  <button type="button" value="ex:event" onclick="setCategory(this.value)">경조사</button>
                  <button type="button" value="ex:saving" onclick="setCategory(this.value)">적금</button>
                  <button type="button" value="ex:other" onclick="setCategory(this.value)">기타</button>
              </div>
              <div class="income">
                  수입<br>
                  <button type="button" value="in:pay" onclick="setCategory(this.value)">월급</button>
                  <button type="button" value="in:allowance" onclick="setCategory(this.value)">용돈</button>
                  <button type="button" value="in:parttime" onclick="setCategory(this.value)">아르바이트</button>
                  <button type="button" value="in:bonus" onclick="setCategory(this.value)">보너스</button>
                  <button type="button" value="in:other" onclick="setCategory(this.value)">기타</button>
              </div>
            </div>
            <input class="modal_go" value="GO" type="submit">
          </form>
        </div>
      </div>
    </div>
  </div>
<!-- //modal -->
<script type="text/javascript" src="mainscript.js"></script>
</body>
<!-- //frame -->
</html>
