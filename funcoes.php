<?php

function dataDiff ($dataI , $dataF) {
    $dataI = explode('-', $dataI);
    $dataF = explode('-', $dataF);

    $diffA = $dataF[0] - $dataI[0];
        if ($diffA==0) {
            $diff = $dataF[1] - $dataI[1];
        } else {
            if ($diffA==1) {
                $diff = (12 - $dataI[1]) + $dataF[1];
            } else {
                $diff = ((12 - $dataI[1]) + $dataF[1]) + (($diffA - 1) * 12);
            }
        }

    return $diff;
}

?>