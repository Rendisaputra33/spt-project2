<?php

function tanggal($tgl)
{
    $timefuture = strtotime($tgl) + 86400;
    return [
        date('Y-m-d', $timefuture)
    ];
}

var_dump(tanggal('2021-08-13'));
