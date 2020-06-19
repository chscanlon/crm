<div class="">

    <form wire:submit.prevent="save" >
        @csrf

        {{ $slot }}

    </form>



</div>