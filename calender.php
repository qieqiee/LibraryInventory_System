<?php
function build_calendar($month,$year){
    $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $firstDayOfMonth = mktime(0,0,$month,1,$year)
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');

    $prev_month = date('m', mktime (0, 0, 0, $month-1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month-1, 1, $year));
    Snext_ month = date('m'", mktime(0, 0, 0, Smonth* 1, 1, $year)):
    Snext_year = date(*Y', mktime(0, 0, 0, $month» 1, 1, $year)):
    Scalendar = "«center» ch2> SmonthName Syear</h2»'
    Scalendar,= "<a class-'btn btn-primary btn-xs' href-?month=". Sprey month. "&year-" Sprev_year. "» Prev Month</as "
    Scalendar.= °<a class-'bin btn-primary btn-xs' href-'? month=". date('m'). "&year-" date(Y*). *» Current Month<la>
    ".
    Scalendar.= *<a class-btn btn-primary btn-xs' href-"?month=" Snext month. "&year=$next years Next
    Month</a></center»* return Scalendar;
}
?>