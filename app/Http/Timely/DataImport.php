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
        StagedCustomer::cursor()->each
        (
            function ($item) use ($importId)
            {
                $customer = Customer::firstOrNew(
                    ['timely_customer_id' => $item->CustomerId],
                    ['created_in_import_id' => $importId]
                );
                $customer->timely_status = 'matched';
                $customer->first_name = $item->FirstName;
                $customer->family_name = $item->LastName;
                $customer->card_index = $item->CompanyName;
                $customer->email = $item->Email;
                $customer->phone = $item->Telephone;
                $customer->sms = $item->SmsNumber;
                $customer->address_line1 = $item->PhysicalAddress1;
                $customer->address_line2 = $item->PhysicalAddress2;
                $customer->suburb = $item->PhysicalSuburb;
                $customer->city = $item->PhysicalCity;
                $customer->state = $item->PhysicalState;
                $customer->postcode = $item->PhysicalPostCode;
                $customer->date_of_birth = new Carbon($item->DateOfBirth);
                $customer->is_vip = ($item->IsVip = 'Y') ? true : false;
                $customer->booking_count = $item->BookingCount;
                $customer->last_booking_date = new Carbon($item->LastBookingDate);
                $customer->gender = $item->Gender;
                $customer->occupation = $item->Occupation;
                $customer->referred_by = $item->ReferredBy;
                $customer->save();
            }
        );

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