<?php

// Set the content type to be in the iCalendar format
header('Content-type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=calendar.ics');

// Set the timezone
date_default_timezone_set('Europe/Berlin');

// Create the iCalendar file content
$icsContent = "BEGIN:VCALENDAR\r\n";
$icsContent .= "VERSION:2.0\r\n";
$icsContent .= "PRODID:-//Lernlinie//Planning Tool\r\n";
$icsContent .= "CALSCALE:GREGORIAN\r\n";

// Add an event
$icsContent .= "BEGIN:VEVENT\r\n";
$icsContent .= "SUMMARY:Re-evaluation of plan for student 1610200\r\n";
$icsContent .= "DTSTART;TZID=Europe/Berlin:20240308T090000\r\n"; // Use the appropriate date-time format
$icsContent .= "DTSTART;TZID=Europe/Berlin:20240308T100000\r\n";   // Use the appropriate date-time format
$icsContent .= "DESCRIPTION:Please re-evaluate the plan of student 1610200 today\r\n";
// $icsContent .= "LOCATION:Sample Location\r\n";
$icsContent .= "UID:" . md5(uniqid(mt_rand(), true)) . "\r\n"; // Generate a unique identifier
$icsContent .= "STATUS:CONFIRMED\r\n";
$icsContent .= "SEQUENCE:0\r\n";
$icsContent .= "BEGIN:VALARM\r\n";
$icsContent .= "TRIGGER:-PT15M\r\n";
$icsContent .= "DESCRIPTION:Reminder\r\n";
$icsContent .= "ACTION:DISPLAY\r\n";
$icsContent .= "END:VALARM\r\n";
$icsContent .= "END:VEVENT\r\n";

// Close the iCalendar file
$icsContent .= "END:VCALENDAR\r\n";

// Save the content to the file
// file_put_contents('assets/ics/', $icsContent);
// $filePath = __DIR__ .'/assets/ics/'.'calendar.ics';
// file_put_contents($filePath, $icsContent);

// Output the content
echo $icsContent;

?>
