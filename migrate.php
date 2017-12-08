<?php include 'calendar.php' ?>
<?php
$day_of_week = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
$month_of_year = array('January','February','March','April','May','June','July','August','September','October','November','December');

//  DECLARE AND INITIALIZE VARIABLESi
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
$day_content = '<font color="#d90057">3000</font><br /> <font color="#ef7c29"> 1000 </font><br /> <font color="#00a28b"> 2000 </font><br /> '

$day_idx = 1;
$week_idx = $weekday;

$cal = '<table class="cal">';
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
    $week_idx = ($week_idx + 1)%7;

    // START NEW ROW FOR FIRST DAY OF WEEK
    if($week_idx == 0){
      $cal .= $TR_start;
    }
    if($week_idx != $DAYS_OF_WEEK) {
      // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES var day  = Calendar.getDate();
      $day = $day_idx;

      // HIGHLIGHT TODAY'S DATE
      if( $today==$day_idx ){
          $cal .= $highlight_start.$span_day_start.$day.$add_btn.$span_day_end.'<br/>';
          $cal .= $day_content;
          $cal .= $highlight_end.$TD_end;
        }

    // PRINTS DAY
    else if( $today < $day_idx){
        $cal .= $TD_start.$span_day_start.$day.$add_btn.$span_day_end.'<br />';
        $cal .= '<br/><br/><br/><font color="#00a28b"> 2000 </font> ';
        $cal .= $TD_end;
      }

    else{
        $cal .= $TD_start.$span_day_start.$day.$add_btn.$span_day_end.'<br />';
        $cal .= $day_content;
        $cal .= $TD_end;
      }
    }

    // END ROW FOR LAST DAY OF WEEK
    if($week_idx == $DAYS_OF_WEEK-1)
      $cal .= $TR_end;
    }

    // INCREMENTS UNTIL END OF THE MONTH
    $day_idx++;

}// end for loop

$cal .= '</TD></TR></TABLE>';

//  PRINT CALENDAR
echo $cal;
?>
