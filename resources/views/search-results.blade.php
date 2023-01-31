<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <link rel="stylesheet" href="app.css">
</head>
<body class="text-sm">
    <div>
        <div class="my-2">
            <table class="margin-auto max-w-lg border border-b-gray-400 rounded-md">
                <tr>
                    <th class="w-1/2 py-1 px-2">Particulars</th>
                    <th class="w-1/2 py-1 px-2">Value</th>
                </tr>

                <tr>
                    <td class="py-1 px-2">Reg. No.</td>
                    <td class="py-1 px-2">{{ $person->regno }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">Name</td>
                    <td class="py-1 px-2">{{ $person->empname }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">Guardian Name</td>
                    <td class="py-1 px-2">{{ $person->guardianname }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">Address</td>
                    <td class="py-1 px-2">{{ $person->empcuraddress }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">DOB</td>
                    <td class="py-1 px-2">{{ $person->dateofbirth }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">Start Date</td>
                    <td class="py-1 px-2">{{ $person->startingdate }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">Reg. Date</td>
                    <td class="py-1 px-2">{{ $person->regdate }}</td>
                </tr>
                <tr>
                    <td>Create Date</td>
                    <td>{{ $person->createdate }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">ID Mark 1</td>
                    <td class="py-1 px-2">{{ $person->idmark1 }}</td>
                </tr>
                <tr>
                    <td class="py-1 px-2">ID Mark 2</td>
                    <td class="py-1 px-2">{{ $person->idmark2 }}</td>
                </tr>
            </table>
        </div>
        <div class="my-2">
            <table class="margin-auto max-w-lg border border-b-gray-400 rounded-md">
                <tr>
                    <th class="py-1 px-2 text-bold">Date</th>
                    <th class="py-1 px-2 text-bold">Voucher No.</th>
                    <th class="py-1 px-2 text-bold">Amount</th>
                    <th class="py-1 px-2 text-bold">Remarks</th>
                </tr>
                @foreach ($amounts as $amt)
                    <tr>
                        <td class="py-1 px-2">{{$amt->transdate}}</td>
                        <td class="py-1 px-2">{{$amt->vouchernum}}</td>
                        <td class="py-1 px-2">{{$amt->amount}}</td>
                        <td class="py-1 px-2">{{$amt->remark}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
</html>
