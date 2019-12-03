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

function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

?>