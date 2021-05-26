<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$event = (new \Eluceo\iCal\Domain\Entity\Event())->setDescription("test")->setSummary("test");
$calendar = new \Eluceo\iCal\Domain\Entity\Calendar([$event]);
$iCalendarComponent = (new \Eluceo\iCal\Presentation\Factory\CalendarFactory())->createCalendar($calendar);
file_put_contents('calendar.ics', (string)$iCalendarComponent);


    ?>

<a href="calendar.ics">Download</a>
