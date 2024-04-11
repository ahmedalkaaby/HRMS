<x-app-layout>
    <x-slot name="header">
        <div class="w-full flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Activities') }}
            </h2>
            <a href="{{ route('activities.export') }}" class="bg-green-700 dark:bg-gray-200 hover:bg-green-500 dark:hover:bg-white text-white font-bold py-2 px-4 rounded leading-tight">
                Export Activities
            </a>
        </div>
    </x-slot>

    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden justify-center fixed z-10 pt-10 left-0 top-0 w-full h-full overflow-auto bg-gray-700 bg-opacity-50">
        <div class="relative p-4 w-full max-w-5xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Terms of Service
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" onclick="closeModal()">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-200 dark:bg-gray-800">
                        <th class="px-4 py-2">Attribute</th>
                        <th class="px-4 py-2">Old</th>
                        <th class="px-4 py-2">New</th>
                    </tr>
                    </thead>
                    <tbody id="modal-content" class="p-4 md:p-5 space-y-4">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr class="bg-gray-200 dark:bg-gray-800">
                                    <th class="px-4 py-2">#</th>
                                    <th class="px-4 py-2">Action</th>
                                    <th class="px-4 py-2">Model</th>
                                    <th class="px-4 py-2">Affected User</th>
                                    <th class="px-4 py-2">By User</th>
                                    <th class="px-4 py-2">Date</th>
                                    <th class="px-4 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td  class="border px-4 py-2">{{ $loop->iteration }}</td>
                                    <td  class="border px-4 py-2">{{ $activity->description }}</td>
                                    <td  class="border px-4 py-2">{{ $activity->subject_type }}</td>
                                    <td  class="border px-4 py-2">{{ $activity->subject->name }}</td>
                                    <td  class="border px-4 py-2">{{ $activity->causer->name }}</td>
                                    <td  class="border px-4 py-2">{{ $activity->created_at }}</td>
                                    <td class='border px-4 py-2'>
                                        <button onclick="openModal({{$activity->properties}})" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                            Changes
                                        </button>
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

</x-app-layout>

<script>
    var modal = document.getElementById("default-modal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    function openModal(properties) {
        modal.style.display = "flex";
        document.getElementById("modal-content").innerHTML = '';

        Object.entries(properties.old).forEach(function(key, value) {
            var htmlStr =
                "<tr>" +
                "<td class='border px-4 py-2'>" +
                key[0] +
                "</td>" +
                "<td class='border px-4 py-2'>" +
                key[1] +
                "</td>" +
                "<td class='border px-4 py-2'>" +
                Object.entries(properties.attributes)[value][1] +
                "</td>" +
                "</tr>"

            document.getElementById("modal-content").innerHTML +=htmlStr;
        });
    }

    function closeModal() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
