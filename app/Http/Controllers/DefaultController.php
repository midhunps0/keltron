<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function showForm()
    {

    }

    public function search(Request $request)
    {
        if ($request->input('search') == null || trim($request->input('search')) == '') {
            return view('search-results');
        }
        // $result = DB::select(
        //     "SELECT regno, empname, guardianname, empcuraddress, dateofbirth, startingdate, regdate, public.registration.createdate, idmark1, idmark2, vouchernum, transdate, amount, remark FROM public.registration JOIN financialaccounting.ledger ON public.registration.regid = financialaccounting.ledger.regid Join public.remarks ON financialaccounting.ledger.remarks = public.remarks.remindex Where regno='8/05/546/100'"
        // );
        $personResults = DB::select(
            "SELECT regno, empname, guardianname, empcuraddress, dateofbirth, startingdate, regdate, public.registration.createdate, idmark1, idmark2 FROM public.registration Where regno='8/05/546/100'"
        );
        $amountResults = DB::select(
            "SELECT financialaccounting.ledger.transdate, financialaccounting.ledger.vouchernum, financialaccounting.ledger.amount, public.remarks.remark FROM public.registration JOIN financialaccounting.ledger ON public.registration.regid = financialaccounting.ledger.regid Join public.remarks ON financialaccounting.ledger.remarks = public.remarks.remindex Where regno='8/05/546/100' ORDER BY financialaccounting.ledger.transdate DESC"
        );

        $p = $personResults[0];
        // dd($amountResults);
        if ($request->expectsJson()) {
            return view('search-results', ['person' => $p, 'amounts' => $amountResults])->fragment('results');
        }
        return view('search-results', ['person' => $p, 'amounts' => $amountResults]);
    }
}
