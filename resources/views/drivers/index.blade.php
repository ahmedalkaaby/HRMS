<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Drivers') }}
            </h2>
            <div>
                <a href="{{ route('drivers.create') }}" class="mx-2 bg-gray-800 dark:bg-gray-200 hover:bg-gray-700 dark:hover:bg-white text-white font-bold py-2 px-4 rounded leading-tight">
                    Create Driver
                </a>
                <a href="{{ route('drivers.export') }}" class="mx-2 bg-green-700 dark:bg-gray-200 hover:bg-green-500 dark:hover:bg-white text-white font-bold py-2 px-4 rounded leading-tight">
                    Export Drivers
                </a>
            </div>
        </div>
    </x-slot>

    @if(session()->has('message'))
        @include('components.custom.flash', ['message' => session('message')])
    @endif

    @include('drivers.pending-drivers')
    @include('drivers.approved-drivers')
    @include('drivers.rejected-drivers')

</x-app-layout>
