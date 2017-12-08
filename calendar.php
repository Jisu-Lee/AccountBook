<?php

try{
$connect = new PDO('mysql:host=localhost;dbname=account_book;charset=utf8', 'root', 'root',
array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    die('Error connecting to database');
}


//수입 거래 내역 가져와서 날짜별로 분류하기
$current_date = date('Y-m-d');
$start_month = date('Y-m-01');
$end_month = date('Y-m-t', strtotime($current_date));
$userID = $_COOKIE['ID'];

$get = $connect->prepare("SELECT amount, category, date_
  FROM transaction WHERE userID = :userID AND date_ >= :start_month
  AND date_ <= :end_month ORDER BY date_");
$get->bindParam(':userID', $userID);
$get->bindParam(':start_month', $start_month);
$get->bindParam(':end_month', $end_month);

$get->execute();

$income_arr = new SplFixedArray(32);
$expense_arr = new SplFixedArray(32);
#string substr ( string $string , int $start [, int $length ] )
if($get->rowCount()>0){
  foreach($get as $row) :
    $day = (int)substr($row[2], 8, 2);
    if(strcmp(substr($row[1], 0, 2), 'in') == 0){
      $income_arr[$day] = (int)$income_arr[$day] + (int)$row[0];
    }else{
      $expense_arr[$day] = (int)$expense_arr[$day] + (int)$row[0];
    }
  endforeach;
}
//예산 설정
$budget_arr = new SplFixedArray(32);
$stmt = $connect->prepare('SELECT amount, startDate, endDate
  FROM budget WHERE userID=:userID');
$stmt->bindParam(':userID', $userID);

$stmt->execute();

$start_day; $end_day;
$row = $stmt->fetch();
$amount = (int)$row[0];

if($stmt->rowCount()>0){
  $current = date('Y-m-d');
  if($row[1] <= $current){
    $start_day = (int)date('d');

    $before_day = date('d', strtotime($row[1]));
    $current_day = date('d');
    for($day=$before_day; $day<$current_day; $day++){
      $amount -= (int)$expense_arr[(int)$day];
    }
  }else{
    $start_day = (int)date('d', strtotime($row[1]));
  }
  $end_day = (int)date('t');
}

$budget_days = $end_day - $start_day + 1;
$budget_per_day = (float)$amount / $budget_days;

for($i=$start_day; $i<=$end_day; $i++){
  $budget_arr[$i] = $budget_per_day - (int)$expense_arr[$i];
}

//달력 생성
$day_of_week = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
$month_of_year = array('January','February','March','April','May','June','July','August','September','October','November','December');

//  DECLARE AND INITIALIZE VARIABLES
$year = (int)date("Y");
$month = (int)date("m");
$today = (int)date("d");

$weekday = (int)date("w");



$DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
$DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
$cal;    // Used for printing

$TR_start = '<TR>';
$TR_end = '</TR>';
$highlight_start = '<TD bgcolor="#bed0db">';
$highlight_end   = '</TD>';
$TD_start = '<TD>';
$TD_end = '</TD>';
$TH_start = '<TH>';
$TH_end = '</TH>';
$span_day_start = '<span class="day_header">';
$span_day_end = '</span>';
$add_btn = '<button type="button" onclick="add()" class="add_btn">+</button>';

$day_idx = 1;
$week_idx = $weekday;

$cal = '<caption>'.date('Y').'-'.date('m').'</caption>';
$cal .= '<table class="cal">';
$cal .= '<thead>'.$TR_start;

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for($index=0; $index < $DAYS_OF_WEEK; $index++)
{
  // BOLD TODAY'S DAY OF WEEK
  if($weekday == $index)
    $cal .= $TH_start.'<font color="red">'.$day_of_week[$index].'</font>'.$TH_end;
  // PRINTS DAY
  else
    $cal .= $TH_start.$day_of_week[$index].$TH_end;
}

$cal .= $TR_end;
$cal .= $TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY
for($index=0; $index < $weekday; $index++){
  $cal .= $TD_start."  ".$TD_end;
}
// LOOPS FOR EACH DAY IN CALENDAR
for($index=0; $index < $DAYS_OF_MONTH; $index++) {
  if( $day_idx > $index ) {
    // RETURNS THE NEXT DAY TO PRINT
    $week_idx = ($week_idx)%7;

    // START NEW ROW FOR FIRST DAY OF WEEK
    if($week_idx == 0){
      $cal .= $TR_start;
    }
    if($week_idx != $DAYS_OF_WEEK) {
      // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES var day  = Calendar.getDate();
    $expense_money = number_format($expense_arr[$day_idx], 0);
    $income_money = number_format($income_arr[$day_idx], 0);
    $budget_money = number_format($budget_arr[$day_idx], 0);
    $day = $day_idx;

      // HIGHLIGHT TODAY'S DATE
      if( $today==$day_idx ){
          $cal .= $highlight_start.$span_day_start.$day.$add_btn.$span_day_end.'<br/>';
          $cal .= '<font color="#d90057">'.$expense_money.'</font><br> <font color="#ef7c29">'.$income_money.'</font><br>
          <font color="#00a28b">'.$budget_money.'</font><br>';
          $cal .= $highlight_end.$TD_end;
        }

    // PRINTS DAY
    else if( $today < $day_idx){
        $cal .= $TD_start.$span_day_start.$day.$add_btn.$span_day_end.'<br />';
        $cal .= '<font color="#d90057">'.$expense_money.'</font><br> <font color="#ef7c29">'.$income_money.'</font><br>
        <font color="#00a28b">'.$budget_money.'</font><br>';
        $cal .= $TD_end;
      }

    else{
        $cal .= $TD_start.$span_day_start.$day.$add_btn.$span_day_end.'<br />';
        $cal .= '<font color="#d90057">'.$expense_money.'</font><br> <font color="#ef7c29">'.$income_money.'</font><br>
        <font color="#00a28b">'.$budget_money.'</font><br>';
        $cal .= $TD_end;
      }
    }

    // END ROW FOR LAST DAY OF WEEK
    if($week_idx == $DAYS_OF_WEEK-1)
      $cal .= $TR_end;
    }

    // INCREMENTS UNTIL END OF THE MONTH
    $day_idx++;
    $week_idx++;

}// end for loop

$cal .= '</TD></TR></TABLE>';

//  PRINT CALENDAR
echo $cal;
?>
