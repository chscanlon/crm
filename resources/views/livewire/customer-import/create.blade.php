<div class="container mx-auto">
    <div class="text-2xl font-bold my-4">New Customer Import</div>

    <div class="mb-2">Customer data are imported from the Timely Customer List report. The report should be exported
        from Timely as a csv file and saved. You can then select the saved file using the form below.
    </div>

    <form wire:submit.prevent="save" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class=" flex items-end">
        
            <div class="">

                <label 
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="customerList"
                >
                    Select a file to upload
                </label>

                <input
                    type="file"
                    wire:model="timelycust"
                    class=""
                    id="customerList"
                    name="customerList"
                    placeholder="Select File"
                >
                @error('timelycust') <span class="error">{{ $message }}</span> @enderror

            </div>

        </div>

        <div>
            @if ($timelycust)
            Filename : {{ $timelycust->getClientOriginalName() }} <br/>
            File Size : {{ round($timelycust->getSize()/1024) }} kB <br/>
            File Type : {{ $timelycust->getMimeType() }} <br/>
            Rows To Import : {{ $rowsStaged }} <br/>

            <div class="">
                <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                >
                    Import File
                </button>       
            </div>
            <br/>
            Rows Imported : {{ $rowsImported }} <br/>

            @endif
        </div>

    </form>

</div>