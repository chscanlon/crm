<?php

namespace App\Http\Livewire\CustomerImport;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Http\Timely\DataImport;
use App\Customer;
use Illuminate\Support\Facades\Log;


class Create extends Component
{
    use WithFileUploads;

    public $customerListReport;
    public $uploadValidated;
    public $rowsStaged;
    public $importId;
    public $totalCustomers;
    public $newCustomers = [];
    public $deletedCustomers = [];

    public function mount()
    {
        $this->uploadValidated = 0;
    }

    public function updatingCustomerListReport()
    {
        $this->uploadValidated = 0;
    }


    public function updatedCustomerListReport()
    {
        // basic file validation
        $this->validate([
            'customerListReport' => 'mimetypes:text/plain|max:1024', // 1MB Max
        ]);

        // need to do some more rigourous checks here to determine the file is in the expected format

        $this->uploadValidated = 1;
        $dataImport = new DataImport;
        $dataImport->stageCustomers($this->customerListReport->getfilename());
        $this->importId = $dataImport->importId;
        $this->rowsStaged = $dataImport->rowsStaged;
    }

    public function save()
    {
        if($this->uploadValidated == 1) {
            $dataImport = new DataImport;
            $this->totalCustomers = $dataImport->ImportStagedCustomers($this->importId);
        }

        $this->newCustomers = Customer::where('created_in_import_id', $this->importId)->limit(10)->get()->toArray();
        $this->deletedCustomers = Customer::where('deleted_in_import_id', $this->importId)->limit(10)->get()->toArray();

        $this->customerListReport = 0;
        $this->uploadValidated == 0;
        //dd($this->newCustomers);

    }

    public function render()
    {
        return view('livewire.customer-import.create');
    }
}