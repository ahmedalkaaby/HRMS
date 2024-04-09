<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="overflow-x-auto">
                    <h1 class="pb-4 font-bold text-3xl text-red-500">Rejected Drivers</h1>

                    <table class="table-auto w-full">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Date of Birth</th>
                            <th class="px-4 py-2">Driver License Date</th>
                            <th class="px-4 py-2">Vehicle Type</th>
                            <th class="px-4 py-2">Rejected Date</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers->whereNull('approved_at')->whereNotNull('rejected_at') as $driver)
                            <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                <td class="border px-4 py-2">{{ $driver->name }}</td>
                                <td class="border px-4 py-2">{{ $driver->email }}</td>
                                <td class="border px-4 py-2">{{ $driver->dob }}</td>
                                <td class="border px-4 py-2">{{ $driver->driver_license }}</td>
                                <td class="border px-4 py-2">{{ $driver->vehicle_type }}</td>
                                <td class="border px-4 py-2">{{ $driver->rejected_at }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('drivers.edit', $driver) }}" class="text-blue-800 hover:text-blue-400 dark:text-blue-500 dark:hover:text-blue-300 px-2">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>