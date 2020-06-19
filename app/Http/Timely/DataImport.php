<?php

namespace App\Http\Timely;

use Illuminate\Support\Facades\DB;
use App\CustomerImport;
use App\Customer;
use App\StagedCustomer;
use Carbon\Carbon;

class DataImport
{
    public $rowsStaged;
    public $importId;

    public function stageCustomers($filepath)
    {
        DB::table('staged_customers')->truncate();

        $query = "LOAD DATA LOCAL INFILE '../storage/app/livewire-tmp/".$filepath."'
                INTO TABLE staged_customers
                FIELDS TERMINATED BY ','
                OPTIONALLY ENCLOSED BY '\"'
                LINES TERMINATED BY '\r\n'
                IGNORE 1 LINES";

        DB::connection()->getPdo()->exec($query);

        // delete any rows that do not contain customer data
        DB::table('staged_customers')->where('CustomerId', '=', '')->delete();
        $this->rowsStaged = DB::table('staged_customers')->count();

        // save customer import metadata
        $customerImport = new CustomerImport;
        $customerImport->imported_at = Carbon::now();
        $customerImport->item_count = $this->rowsStaged;
        $customerImport->save();
        $this->importId = $customerImport->id;
    }

    public function ImportStagedCustomers($importId)
    {
        //$imports = CustomerImport::cursor();

        $customers = StagedCustomer::cursor()->map(function ($import) use ($importId) {
            $cust = Customer::firstOrNew(
                ['timely_customer_id' => $import->CustomerId],
                ['created_in_import_id' => $importId]
            );
            $cust->timely_status = 'matched';
            $cust->first_name = $import->FirstName;
            $cust->family_name = $import->LastName;
            $cust->card_index = $import->CompanyName;
            $cust->email = $import->Email;
            $cust->phone = $import->Telephone;
            $cust->sms = $import->SmsNumber;
            $cust->address_line1 = $import->PhysicalAddress1;
            $cust->address_line2 = $import->PhysicalAddress2;
            $cust->suburb = $import->PhysicalSuburb;
            $cust->city = $import->PhysicalCity;
            $cust->state = $import->PhysicalState;
            $cust->postcode = $import->PhysicalPostCode;
            $cust->date_of_birth = new Carbon($import->DateOfBirth);
            $cust->is_vip = ($import->IsVip = 'Y') ? true : false;
            $cust->booking_count = $import->BookingCount;
            $cust->last_booking_date = new Carbon($import->LastBookingDate);
            $cust->gender = $import->Gender;
            $cust->occupation = $import->Occupation;
            $cust->referred_by = $import->ReferredBy;
            $cust->save();

            return $cust->id;
        })->all();

        DB::table('customers')
            ->where('timely_status', 'active')
            ->update(['timely_status' => 'deleted', 'deleted_in_import_id' => $importId]);

        DB::table('customers')
            ->where('timely_status', 'matched')
            ->update(['timely_status' => 'active']);

        return DB::table('customers')->count();
    }


    public function ImportStagedAppointments()
    {


    }
}