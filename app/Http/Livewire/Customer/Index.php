<?php

namespace App\Http\Livewire\Customer;

use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.customer.index');
    }
}
