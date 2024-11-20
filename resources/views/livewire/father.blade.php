<div>
    <h1 class="text-2xl font-semibold">
        Componente principal
    </h1>
    <x-input wire:model.live="name"></x-input>
    <hr class="my-6">
    <div>
        <livewire:children wire:model="name" />
        {{-- @livewire('children',["name"=>$name]) --}}
    </div>
</div>
