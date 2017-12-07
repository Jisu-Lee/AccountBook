
var day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
var month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

//  DECLARE AND INITIALIZE VARIABLES
var Calendar = new Date();

var year = Calendar.getFullYear();     // Returns year
var month = Calendar.getMonth();    // Returns month (0-11)
var today = Calendar.getDate();    // Returns day (1-31)
var weekday = Calendar.getDay();    // Returns day (1-31)

var DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
var DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
var cal;    // Used for printing

Calendar.setDate(1);    // Start the calendar day at '1'
Calendar.setMonth(month);    // Start the calendar month at now


/* VARIABLES FOR FORMATTING
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
      tags to customize your caledanr's look. */

var TR_start = '<TR>';
var TR_end = '</TR>';
var highlight_start = '<TD bgcolor="#bed0db">';
var highlight_end   = '</TD>';
var TD_start = '<TD>';
var TD_end = '</TD>';
var TH_start = '<TH>';
var TH_end = '</TH>';
var span_day_start = '<span class="day_header">';
var span_day_end = '</span>';
var add_btn = '<button type="button" onclick="add()" class="add_btn">+</button>';
var day_content = '<font color="#d90057">3000</font><br /> <font color="#ef7c29"> 1000 </font><br /> <font color="#00a28b"> 2000 </font><br /> '

/* BEGIN CODE FOR CALENDAR
NOTE: You can format the 'BORDER', 'BGCOLOR', 'CELLPADDING', 'BORDERCOLOR'
tags to customize your calendar's look.*/

cal = '<table class="cal">';
cal += '<thead>' + TR_start;

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for(index=0; index < DAYS_OF_WEEK; index++)
{

// BOLD TODAY'S DAY OF WEEK
if(weekday == index)
  cal += TH_start + '<font color="red">' + day_of_week[index] + '</font>' + TH_end;

// PRINTS DAY
else
  cal += TH_start + day_of_week[index] + TH_end;
}

cal += TR_end;
cal += TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY
for(index=0; index < Calendar.getDay(); index++)
cal += TD_start+ '  ' + TD_end;

// LOOPS FOR EACH DAY IN CALENDAR
for(index=0; index < DAYS_OF_MONTH; index++)
{
if( Calendar.getDate() > index )
{
  // RETURNS THE NEXT DAY TO PRINT
  week_day =Calendar.getDay();

  // START NEW ROW FOR FIRST DAY OF WEEK
  if(week_day == 0)
  cal += TR_start;

  if(week_day != DAYS_OF_WEEK)
  {

  // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
  var day  = Calendar.getDate();

  // HIGHLIGHT TODAY'S DATE
  if( today==Calendar.getDate() ){
      cal += highlight_start + span_day_start + day + add_btn + span_day_end + '<br/>';
      cal += day_content;
      cal += highlight_end + TD_end;
    }

  // PRINTS DAY
  else if( today < Calendar.getDate()){
      cal += TD_start + span_day_start + day + add_btn + span_day_end + '<br />';
      cal += '<br/><br/><br/><font color="#00a28b"> 2000 </font> ';
      cal += TD_end;
    }

  else{
      cal += TD_start + span_day_start + day + add_btn + span_day_end + '<br />';
      cal += day_content;
      cal += TD_end;
    }
  }

  // END ROW FOR LAST DAY OF WEEK
  if(week_day == DAYS_OF_WEEK)
  cal += TR_end;
  }

  // INCREMENTS UNTIL END OF THE MONTH
  Calendar.setDate(Calendar.getDate()+1);

}// end for loop

cal += '</TD></TR></TABLE>';

//  PRINT CALENDAR
document.write(cal);
