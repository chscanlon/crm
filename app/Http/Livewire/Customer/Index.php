<?php

namespace App\Http\Livewire\Customer;

use App\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.customer.index', ['customers' => Customer::where('timely_status', 'active')->paginate(15)]);
    }
}
