<?php
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}


//configuração de Timezone
date_default_timezone_set("Brazil/West");
$data = filter_input(INPUT_GET, 'data');
$data = filter_input(INPUT_GET, 'chamada_data');
if ($data == null) {
    $data = date("d_m_Y");
}

if (str_contains($data, "_")) {
    $d = explode("_", $data);
    if (count($d) == 3) {
        $day = $d[0];
        $year = $d[2];
        $month = $d[1];
    } else {
        $day = 0;
        $year = $d[1];
        $month = $d[0];
    }
} else if (str_contains($data, "-")) {
    $d = explode("-", $data);
    if (count($d) == 3) {
        $day = $d[2];
        $year = $d[0];
        $month = $d[1];
    } else {
        $day = 0;
        $year = $d[0];
        $month = $d[1];
    }
}

$next = $day + 1;
$prev = $day - 1;

$date = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
$currentDate = date("d/m/Y", mktime(0, 0, 0, $month, $day, $year));
$currentMonth = date("m/Y", mktime(0, 0, 0, $month, $day, $year));


$nextDate = date("d_m_Y", mktime(0, 0, 0, $month, $next, $year));
$previousDate = date("d_m_Y", mktime(0, 0, 0, $month, $prev, $year));

$nextM = $month + 1;
$prevM = $month - 1;
$nextMonth = date("m_Y", mktime(0, 0, 0, $nextM, $day, $year));
$previousMonth = date("m_Y", mktime(0, 0, 0, $prevM, $day, $year));

// var_dump($date);