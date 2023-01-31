<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function showForm()
    {

    }

    public function search()
    {
        $result = DB::unprepared(
            "SELECT regno, empname, vouchernum, transdate, amount, remark FROM public.registration JOIN financialaccounting.ledger ON public.registration.regid = financialaccounting.ledger.regid Join public.remarks ON financialaccounting.ledger.remarks = public.remarks.remindex Where regno='8/05/546/100'"
        )->get();
        dd($result);
    }
}
