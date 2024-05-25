<?php

use App\Models\Pengajuan;

function genNo() {
    $a = Pengajuan::select(DB::raw(
        "
        concat(".date('Y').",'-', LPAD(CAST(right(order_no,4) as UNSIGNED) +1 , 4, '0')) as no
        "
    ))->whereRaw("left(order_no,4) = ?",[date('Y')])->orderBy(DB::raw("CAST(right(order_no,4) as UNSIGNED)"), 'desc')->first();
    if($a) {
        return  $a->no;
    }

    return date('Y')."-0001";
}
