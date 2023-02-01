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
            searchresults: [],
            member: {},
            transactions: [],
            regno: '',
            loading: false,
            getDetails(rno) {
                let p = {};
                p.search = rno;
				let formData = new FormData();
				formData.append('search', rno);
                this.loading = true;
                axios.post(
                    '{{ route('details.post') }}', formData, {
						headers: {
						'Content-Type': 'multipart/form-data'
						}
					}).then((r) => {
                    console.log(r.data);
                    document.getElementById('detailsdiv').innerHTML = r.data;
                    this.loading = false;
                }).catch((e) => {
                    console.log(e);
                    this.loading = false;
                });
            },
            doSearch() {
                if (this.regno.trim() == '') {
                    alert('Please enter a register number');
                } else {
				 	let formData = new FormData();
				 	formData.append('search', this.regno);
                    this.loading = true;

				 	axios.post('{{ route('search') }}', formData, {
						headers: {
						'Content-Type': 'multipart/form-data'
						}
					}).then((r) => {
                        console.log(r.data.results);
                        this.searchresults = r.data.results;
                        this.loading = false;
				 		console.log(this.searchresults);
					}).catch(function (e) {
						console.log(e);
					});
                }
            },
            reset() {
                document.getElementById('resultsdiv').innerHTML = '';
            }
        }" class="flex flex-wrap items-stretch justify-start min-h-screen">
        <div class="w-1/5 p-4 print:hidden bg-gray-200">
            <form action="" class="w-full border bg-gray-400 border-gray-500 rounded-md">
                <div class="my-4 p-0">
                    <label class="font-bold mb-4">Search by Reg. No.</label>
                    <input x-model="regno" type="text" class="w-full" required>
                </div>
                <div class="flex flex-row justify-evenly my-4 p-0">
                    <button @click.prevent.stop="reset()"
                        class="px-2 py-1 bg-gray-500 hover:bg-gray-300 rounded-md shadow-md text-white hover:text-gray-600 transition-all"
                        type="button">Clear</button>
                    <button @click.prevent.stop="doSearch()"
                        class="px-2 py-1 bg-green-600 hover:bg-green-300 rounded-md shadow-md text-white hover:text-gray-600 transition-all"
                        type="submit">Submit</button>
                </div>
            </form>
            <div x-show="searchresults.length > 0" id="resultsdiv" class="w-full">
                <h3 class="px-2 my-2 font-bold">Click to load details</h3>
                <ul>
                    <template x-for="result in searchresults">
                        <li>
                            <button @click="getDetails(result.regno)" type="button" class="bg-gray-100 border-b border-gray-400 my-1 block w-full" x-text="result.empname + ', ' + result.regno"></button>
                        </li>
                    </template>
                </ul>
            </div>
        </div>
        <div id="detailsdiv" class=" relative w-4/5 flex flex-col">
            @if (isset($persons) && isset($amounts))
                @fragment('results')
                    @if (count($persons) == 0)
                    <div>
                        <h3 class="text-center text-red-400 text-xl my-4">No member found.</h3>
                    </div>
                    @else
                    @php
                        $person = $persons[0];
                    @endphp
                    <button type="button"
                        class="bg-gray-500 hover:bg-gray-300 text-white hover:text-gray-600 px-2 py-1 rounded-md shadow-md absolute top-2 right-2"
                        @click.stop.prevent="window.print()">Print</button>
                    <div>
                        <h3 class="text-center font-bold underline text-xl my-2">Member details</h3>
                    </div>
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
                        <div class="w-1/2 min-w-fit my-2 p-1 border border-gray-300 rounded-md">
                            <h3 class="text-center font-bold underline text-lg my-1 ">Transaction details</h3>
                            {{-- @if (count($amounts) > 0) --}}
                            <table class="w-full min-w-[350px] m-auto max-w-lg overflow-hidden">
                                <tr>
                                    <th class="py-1 px-2 text-bold">Date</th>
                                    <th class="py-1 px-2 text-bold">Voucher No.</th>
                                    <th class="py-1 px-2 text-bold">Amount</th>
                                    <th class="py-1 px-2 text-bold">Tenure</th>
                                </tr>
                                @forelse ($amounts as $amt)
                                    <tr>
                                        <td class="py-1 px-2">{{ $amt->transdate }}</td>
                                        <td class="py-1 px-2">{{ $amt->vouchernum }}</td>
                                        <td class="py-1 px-2">{{ $amt->amount }}</td>
                                        <td class="py-1 px-2">{{ $amt->remark }}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No transactions recorded for this user.</td>
                                </tr>
                                @endforelse
                            </table>
                            {{-- @endif --}}
                        </div>
                    </div>
                    @endif
                @endfragment
            {{-- @else
                <div class="my-2 flex flex-wrap space-x-2 justify-evenly items-stretch">
                    <h3 class="text-center font-bold underline text-lg my-1 text-red-400">No details found.</h3>
                </div> --}}
            @endif
        </div>
        <div x-show="loading" class="fixed top-0 left-0 h-screen w-screen bg-gray-900 opacity-40 z-50 flex flex-row items-center justify-center">
                <img src="loading.gif" class="h-16 w-16">
        </div>
    </div>
    <script src="app.js" type="text/javascript"></script>
</body>

</html>
