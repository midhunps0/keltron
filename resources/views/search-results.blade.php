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
    <div x-data="{
        showResults: false,
        member: {},
        transactions: [],
        regno: '',
        submitForm() {
            let p = {};
            p[search] = this.regno;
            axios.get(
                '{{route('search')}}',
                {
                    params: p
                }
            ).then((r) => {
                console.log(r.data);
                document.getElementById('resultsdiv').innerHTML = r.data;
            }).catch((e) => {
                console.log(e);
            });
            this.showResults = true;
        },
        reset() {
            document.getElementById('resultsdiv').innerHTML = '';
        }
    }" x-init="console.log({{ json_encode($person) }});
    console.log({{ json_encode($amounts) }});" class="flex flex-wrap items-stretch justify-start min-h-screen">
        <div class="w-1/5 p-4 print:hidden bg-gray-200">
            <form action="" class="w-full border border-gray-500 rounded-md">
                <div class="my-4 p-0">
                    <label class="font-bold mb-4">Search by Reg. No.</label>
                    <input x-model="regno" type="text" class="w-full" required>
                </div>
                <div class="flex flex-row justify-evenly my-4 p-0">
                    <button @click.prevent.stop="reset()"
                        class="px-2 py-1 bg-gray-500 hover:bg-gray-300 rounded-md shadow-md text-white hover:text-gray-600 transition-all"
                        type="button">Clear</button>
                    <button @click.prevent.stop="submitForm()"
                        class="px-2 py-1 bg-green-600 hover:bg-green-300 rounded-md shadow-md text-white hover:text-gray-600 transition-all"
                        type="submit">Submit</button>
                </div>
            </form>
        </div>
        @fragment('results')
        <div id="resultsdiv" class=" relative w-4/5 flex flex-col">
            <button type="button"
                class="bg-gray-500 hover:bg-gray-300 text-white hover:text-gray-600 px-2 py-1 rounded-md shadow-md absolute top-2 right-2"
                @click.stop.prevent="window.print()">Print</button>
            <div>
                <h3 class="text-center font-bold underline text-xl my-1">Member details</h3>
            </div>
            @if (isset($person) && isset($amounts))
            <div class="my-2 flex flex-wrap space-x-2 justify-evenly items-stretch">
                <div class="w-2/5 min-w-fit p-1 border border-gray-300 rounded-md">
                    <h3 class="text-center font-bold underline text-lg my-1">Personal details</h3>
                    <table
                        class="w-full min-w-[350px] m-auto max-w-lg border border-gray-400 rounded-md overflow-hidden">
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
                            <td class="py-1 px-2">Create Date</td>
                            <td class="py-1 px-2">{{ $person->createdate }}</td>
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
                <div class="w-2/5 min-w-fit my-2 p-1 border border-gray-300 rounded-md">
                    <h3 class="text-center font-bold underline text-lg my-1 ">Transaction details</h3>
                    <table class="w-full min-w-[350px] m-auto max-w-lg overflow-hidden">
                        <tr>
                            <th class="py-1 px-2 text-bold">Date</th>
                            <th class="py-1 px-2 text-bold">Voucher No.</th>
                            <th class="py-1 px-2 text-bold">Amount</th>
                            <th class="py-1 px-2 text-bold">Tenure</th>
                        </tr>
                        @foreach ($amounts as $amt)
                            <tr>
                                <td class="py-1 px-2">{{ $amt->transdate }}</td>
                                <td class="py-1 px-2">{{ $amt->vouchernum }}</td>
                                <td class="py-1 px-2">{{ $amt->amount }}</td>
                                <td class="py-1 px-2">{{ $amt->remark }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @else
            <div class="my-2 flex flex-wrap space-x-2 justify-evenly items-stretch">
                <h3 class="text-center font-bold underline text-lg my-1 text-red-400">No details found.</h3>
            </div>
            @endif
        </div>
        @endfragment
    </div>

    <script src="app.js" type="text/javascript"></script>
</body>

</html>
