<div class=" my-2 p-4 bg-white rounded-md shadow-md">

    <form wire:submit.prevent="save">
        @csrf

        {{ $slot }}

    </form>



</div>