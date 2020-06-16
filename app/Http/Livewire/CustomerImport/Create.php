<?php

namespace App\Http\Livewire\CustomerImport;

use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{

    use WithFileUploads;

    public $upload;
    public $uploadedPath;

    protected function importCustomerList($filepath)
    {
        DB::table('customer_imports')->truncate();

        $query = "LOAD DATA LOCAL INFILE '../storage/app/".$filepath."'
                INTO TABLE customer_imports
                FIELDS TERMINATED BY ','
                OPTIONALLY ENCLOSED BY '\"'
                LINES TERMINATED BY '\r\n'
                IGNORE 2 LINES";

        DB::connection()->getPdo()->exec($query);

        $deleted = DB::table('customer_imports')->where('CustomerId', '=', '')->delete();

        return DB::table('customer_imports')->count();
    }

    public function save()
    {
        $this->upload->store('customer');
        $this->uploadedPath = $this->upload->path();

    }

    public function render()
    {
        return view('livewire.customer-import.create');
    }
}
