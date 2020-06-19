<?php

namespace App\Http\Livewire\CustomerImport;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Http\Timely\DataImport;

class Create extends Component
{
    use WithFileUploads;

    public $timelycust;
    public $rowsStaged;
    public $importId;
    public $rowsImported;


    public function updatedTimelycust()
    {
        $this->validate([
            'timelycust' => 'mimetypes:text/plain|max:1024', // 1MB Max
        ]);

        if($this->timelycust->isValid()) {
            $dataImport = new DataImport;
            $dataImport->stageCustomers($this->timelycust->getfilename());
            $this->importId = $dataImport->importId;
            $this->rowsStaged = $dataImport->rowsStaged;
        }
    }

    public function save()
    {

        if($this->timelycust->isValid()) {
            $dataImport = new DataImport;
            $this->rowsImported = $dataImport->ImportStagedCustomers($this->importId);
        }

    }

    public function render()
    {
        return view('livewire.customer-import.create');
    }
}