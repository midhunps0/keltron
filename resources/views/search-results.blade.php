<div>
    <div>
        <table>
            <tr>
                <th>Particulars</th>
                <th>Value</th>
            </tr>

            <tr>
                <td>Reg. No.</td>
                <td>{{ $person->regno }}</td>
            </tr>
            <tr>
                <td>Name</td>
                <td>{{ $person->empname }}</td>
            </tr>
            <tr>
                <td>Guardian Name</td>
                <td>{{ $person->guardianname }}</td>
            </tr>
            <tr>
                <td>Address</td>
                <td>{{ $person->empcuraddress }}</td>
            </tr>
            <tr>
                <td>DOB</td>
                <td>{{ $person->dateofbirth }}</td>
            </tr>
            <tr>
                <td>Start Date</td>
                <td>{{ $person->startingdate }}</td>
            </tr>
            <tr>
                <td>Reg. Date</td>
                <td>{{ $person->regdate }}</td>
            </tr>
            <tr>
                <td>Create Date</td>
                <td>{{ $person->createdate }}</td>
            </tr>
            <tr>
                <td>ID Mark 1</td>
                <td>{{ $person->idmark1 }}</td>
            </tr>
            <tr>
                <td>ID Mark 2</td>
                <td>{{ $person->idmark2 }}</td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <tr>
                <th>Date</th>
                <th>Voucher No.</th>
                <th>Amount</th>
                <th>Remarks</th>
            </tr>
            @foreach ($amounts as $amt)
                <tr>
                    <td>{{$amt->transdate}}</td>
                    <td>{{$amt->vouchernum}}</td>
                    <td>{{$amt->amount}}</td>
                    <td>{{$amt->remark}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
