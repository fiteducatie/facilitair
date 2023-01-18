<x-app-layout>
    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-gray-200 p-4 rounded-lg">
            <h2 class="text-lg font-medium mb-2">Users</h2>
            <p class="text-gray-700">Total users: 500</p>
            <p class="text-gray-700">Active users: 300</p>
            <p class="text-gray-700">Inactive users: 200</p>
        </div>
        <div class="bg-gray-200 p-4 rounded-lg">
            <h2 class="text-lg font-medium mb-2">Reports</h2>
            <p class="text-gray-700">Total reports: 50</p>
            <p class="text-gray-700">Open reports: 25</p>
            <p class="text-gray-700">Closed reports: 25</p>
        </div>
    </div>
    <div class="mt-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
            Generate Report
        </button>
    </div>

</x-app-layout>
