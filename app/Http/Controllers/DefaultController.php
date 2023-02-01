<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function search(Request $request)
    {
        // 8/05/546/100
        $search = $request->input('search');

        $hasDigits = false;
        for ($i = 0; $i < strlen($search); $i++) {
            if (ctype_digit($search[$i])) {
                $hasDigits = true;
                break;
            }
        }
        $qstr = "SELECT regno, empname, guardianname, empcuraddress, dateofbirth, startingdate, regdate, public.registration.createdate, idmark1, idmark2 FROM public.registration ";
        if (!$hasDigits) {
            $qstr .= "Where empname LIKE '%$search%'";
        } else {
            $qstr .= "Where regno LIKE '%$search'";
        }
        $results = DB::select($qstr);
        //
        return response()->json(
            [
                'results' => $results
            ]
        );
    }

    public function details(Request $request)
    {
        if ($request->input('search') == null || trim($request->input('search')) == '') {
            if ($request->expectsJson()) {
                return view('search-results')->fragment('results');
            }
            return view('search-results');
        }
        $search = $request->input('search');
        $personResults = DB::select(
            "SELECT regno, empname, guardianname, empcuraddress, dateofbirth, startingdate, regdate, public.registration.createdate, idmark1, idmark2 FROM public.registration Where regno='$search'"
        );
        $amountResults = DB::select(
            "SELECT financialaccounting.ledger.transdate, financialaccounting.ledger.vouchernum, financialaccounting.ledger.amount, public.remarks.remark FROM public.registration JOIN financialaccounting.ledger ON public.registration.regid = financialaccounting.ledger.regid Join public.remarks ON financialaccounting.ledger.remarks = public.remarks.remindex Where regno='$search' ORDER BY financialaccounting.ledger.transdate DESC"
        );

        if ($request->expectsJson()) {
            return view('search-results', ['persons' => $personResults, 'amounts' => $amountResults])->fragment('results');
        }
        return view('search-results', ['persons' => $personResults, 'amounts' => $amountResults]);
    }
}
