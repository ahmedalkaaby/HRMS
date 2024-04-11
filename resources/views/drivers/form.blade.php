<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Drivers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div >
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Driver Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("Update driver information and email address along with needed attachments.") }}
                            </p>
                        </header>

                        <form id="driver-form" action="{{ isset($driver) ? route('drivers.update', $driver) : route('drivers.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-6">
                            @csrf
                            @isset($driver)
                                @method('PUT')
                            @endisset

                            <div class="flex items-center space-x-6">
                                <div class="shrink-0">
                                    <img id='avatar' class="h-24 w-24 object-cover rounded-full border" src="{{ isset($driver->avatar) ? asset('storage/' . $driver->avatar?->file_path) : asset('storage/placeholder.png') }}" alt="avatar" />
                                </div>
                                <label class="block">
                                    <span class="sr-only">Choose profile photo</span>
                                    <input name="avatar" id="avatar" accept="image/*" type="file" onchange="loadFile(event)" class="block w-full text-sm text-slate-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-violet-50 file:text-violet-700
                                    hover:file:bg-violet-100
                                  "/>
                                </label>
                            </div>

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $driver->name ?? '')" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $driver->email ?? '')" required autocomplete="email" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="dob" :value="__('Date of Birth')" />
                                <x-date-picker id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $driver->dob ?? '')" autocomplete="dob" />
                                <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                            </div>

                            <div>
                                <x-input-label for="driver_license" :value="__('Driver License Date')" />
                                <x-date-picker id="driver_license" name="driver_license" type="date" class="mt-1 block w-full" :value="old('driver_license', $driver->driver_license ?? '')" autocomplete="driver_license" />
                                <x-input-error class="mt-2" :messages="$errors->get('driver_license')" />
                            </div>

                            <div>
                                <x-input-label for="vehicle_type" :value="__('Vehicle Type')" />
                                <x-text-input id="vehicle_type" name="vehicle_type" type="text" class="mt-1 block w-full" :value="old('vehicle_type', $driver->vehicle_type ?? '')" autocomplete="vehicle_type" />
                                <x-input-error class="mt-2" :messages="$errors->get('vehicle_type')" />
                            </div>

                            @isset($driver)
                                @include('components.custom.attachments')
                            @endisset

                            @if($attachments)
                                <div class="flex justify-around grid grid-cols-2">
                                    @foreach($attachments as $attachment)
                                        @if (str_contains($attachment->mime_type, "image") !== false)
                                            <img class="p-8" src="{{asset('storage/' . $attachment->file_path)}}" alt="img">
                                        @endif
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center gap-4 w-full flex-row justify-end">
                                <button type="submit" class="mt-8 bg-gray-800 dark:bg-gray-200 hover:bg-gray-700 dark:hover:bg-white text-white font-bold py-2 px-4 rounded leading-tight">
                                    {{ isset($driver) ? 'Update' : 'Create' }} Driver
                                </button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    var loadFile = function(event) {

        var input = event.target;
        var file = input.files[0];
        var type = file.type;

        var output = document.getElementById('avatar');

        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };

    var form = document.getElementById("driver-form");
    var elements = form.elements;
    var isApproved = @json(isset($driver->approved_at));
    var isRejected = @json(isset($driver->rejected_at));

    if (isApproved || isRejected)
    for (var i = 0, len = elements.length; i < len; ++i) {
        elements[i].readOnly = true;
        elements[i].style.backgroundColor = "#e9ecef";
        elements[i].style.cursor = "not-allowed";
    }
</script>
