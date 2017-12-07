<!DOCTYPE html>
<? if (!isset($_COOKIE["ID"]) || !isset($_COOKIE["password"])) { ?>
		<p style="text-align: center;">로그인되지 않았습니다.</p>
		<? } else { ?>
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
          <li class="nav-item"> <a href="" class="nav-link">메인</a> </li>
          <li class="nav-item"> <a href="" class="nav-link">통계</a> </li>
          <li class="nav-item"> <a href="" class="nav-link">회원정보</a> </li>
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
            Start : <input type="date" size="5"name="startDate">
            End : <input type="date" size="5" name="endDate" >
            amount : <input type="text" size="3" name="amount" >
            <input type="submit" value="Save"/>
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
              <td> 1000000 </td>
              <td> 100000 </td>
              <td> 900000 </td>
            </tr>
        </table>
      </div>
      <script type="text/javascript" src="calendar.js"></script>
      <table class="week_total">
        <thead> <tr> <th> 주간지출 </th> </tr></thead>
        <tbody>
        <tr><td> 50000 </td></tr>
        <tr><td> 40000 </td></tr>
        <tr><td> 30000 </td></tr>
        <tr><td> 20000 </td></tr>
        <tr><td> 10000 </td></tr>
      </tbody>
      </table>
    </div>
  </div>
    <!-- //container -->
    <div class="footer" >
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
          <div class="modal_date">
              날짜<br>
              <input type="text" id="date" value="20171109">
          </div>
          <div class="modal_detail">
              상세내역<br>
              <input type="text" id="detail">
          </div>
          <div class="modal_price">
              금액<br>
              <input type="text" id="price">
          </div>
          <div class="modal_category">
              카테고리<br>
              <div class="expense">
                  지출<br>
                  <button type="button">음식</button>
                  <button type="button">의류</button>
                  <button type="button">문화생활</button>
                  <button type="button">생필품</button>
                  <button type="button">경조사</button>
                  <button type="button">적금</button>
                  <button type="button">기타</button>
              </div>
              <div class="income">
                  수입<br>
                  <button type="button">월급</button>
                  <button type="button">용돈</button>
                  <button type="button">아르바이트</button>
                  <button type="button">보너스</button>
                  <button type="button">기타</button>
              </div>
          </div>
          <div class="modal_go">
              <button type="button">GO</button>
          </div>
      </div>
    </div>
  </div>
<!-- //modal -->
</body>
<script type="text/javascript" src="mainscript.js"></script>
<!-- //frame -->
</html>
