<?php

// function tanggal($tgl)
// {
//     $timefuture = strtotime($tgl) + 86400;
//     return [
//         date('Y-m-d', $timefuture)
//     ];
// }

// var_dump(tanggal('2021-08-13'));

$str = "rendi&saputra&&xi";

$data = explode('&', $str);

var_dump($data);

echo (array_pop($data));
// $patern = "/&&/";

// $xheck = preg_match($patern, $str);

// if ($xheck) {
//     echo ('true');
// } else {
//     echo ('false');
// }
