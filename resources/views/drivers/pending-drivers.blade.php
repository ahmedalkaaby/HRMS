<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="overflow-x-auto">
                    <h1 class="pb-4 font-bold text-3xl text-yellow-500">Pending Drivers</h1>

                    <table class="table-auto w-full">
                        <thead>
                        <tr class="bg-gray-200 dark:bg-gray-800">
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Date of Birth</th>
                            <th class="px-4 py-2">Driver License Date</th>
                            <th class="px-4 py-2">Vehicle Type</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">!</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($drivers->whereNull('approved_at')->whereNull('rejected_at') as $driver)
                            <tr class="{{ $loop->even ? 'bg-gray-100 dark:bg-gray-800' : '' }}">
                                <td class="border px-4 py-2">{{ $driver->name }}</td>
                                <td class="border px-4 py-2">{{ $driver->email }}</td>
                                <td class="border px-4 py-2">{{ $driver->dob }}</td>
                                <td class="border px-4 py-2">{{ $driver->driver_license }}</td>
                                <td class="border px-4 py-2">{{ $driver->vehicle_type }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('drivers.edit', $driver) }}" class="text-blue-800 hover:text-blue-400 dark:text-blue-500 dark:hover:text-blue-300 px-2">Edit/View</a>
                                    <a href="{{ route('drivers.approve-or-reject', [$driver->id, 'approved_at']) }}" class="text-green-500 hover:text-green-800 dark:text-green-500 dark:hover:text-green-300 px-2">Approve</a>
                                    <a href="{{ route('drivers.approve-or-reject', [$driver->id, 'rejected_at']) }}" class="text-red-500 hover:text-red-800 dark:text-red-500 dark:hover:text-red-300 px-2">Reject</a>
                                </td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('drivers.delete', $driver) }}" class="text-red-500 hover:text-red-800 dark:text-red-500 dark:hover:text-red-300 px-2">Delete</a>
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