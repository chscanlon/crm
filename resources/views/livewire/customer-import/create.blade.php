<div>
    <x-layout.section.header>Import Customer Data</x-layout.section.header>

    <x-layout.section.paragraph>
        Customer data are imported from the Timely Customer List report. Export the Timely report as a csv file. You can then select the saved file using the form below.
    </x-layout.section.paragraph>

    <x-layout.section.form-block-feature>

        <input type="file" wire:model="customerListReport">

        @error('customerListReport')
            <div class=" mt-4 mx-10 p-4 bg-red-100 rounded-md">
                <span class=" text-base font-bold">File failed validation : </span><span class="error">{{ $message }}</span>
            </div>
        @enderror

        @if ($customerListReport And $uploadValidated == 1)
        <div class="flex items-center mt-4 mx-10 p-4 bg-green-100 rounded-md">

            <div class="">
                <div class=" text-base font-bold">
                    File passed vailidation
                </div>
                <x-layout.section.no-bullet-list-item>
                    File Size : {{ round($customerListReport->getSize()/1024) }} kB
                </x-layout.section.no-bullet-list-item>
                <x-layout.section.no-bullet-list-item>
                    File Type : {{ $customerListReport->getMimeType() }}
                </x-layout.section.no-bullet-list-item>
                <x-layout.section.no-bullet-list-item>
                    Rows To Import : {{ $rowsStaged }}
                </x-layout.section.no-bullet-list-item>
            </div>

            <x-layout.section.form-submit>
                Import Now
            </x-layout.section.form-submit>


        </div>

    
        @endif


    </x-layout.section.form-block-feature>


    Rows Imported : {{ $rowsImported }} <br/>
    New Customers : {{ count($newCustomers) }} <br/>

    @if (count($newCustomers) >= 1)
        <div class="my-4">

            <table class="border table-auto">
                <thead>
                    <tr>
                        <th>Timely Customer Id</th>
                        <th>First Name</th>
                        <th>Family Name</th>
                        <th>SMS Number</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($newCustomers as $key => $value)
                    <tr>
                        <td> {{$newCustomers[$key]['timely_customer_id']}} </td>
                        <td> {{$newCustomers[$key]['first_name']}} </td>
                        <td> {{$newCustomers[$key]['family_name']}} </td>
                        <td> {{$newCustomers[$key]['sms']}} </td>
                        <td> {{$newCustomers[$key]['email']}} </td>

                    </tr>
                    @endforeach
                </tbody>
    
            </table>
    
        </div>
    @endif
</div>
