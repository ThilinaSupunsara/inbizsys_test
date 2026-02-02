<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Supplier Management</h2>

        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-1 h-fit">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">
                    {{ $isEditMode ? 'Edit Supplier' : 'Add New Supplier' }}
                </h3>

                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input wire:model="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                        <input wire:model="email" type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Phone</label>
                        <input wire:model="phone" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Address</label>
                        <textarea wire:model="address" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                            {{ $isEditMode ? 'Update' : 'Save' }}
                        </button>

                        @if($isEditMode)
                            <button wire:click="cancel" type="button" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline transition duration-150">
                                Cancel
                            </button>
                        @endif
                    </div>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Supplier List</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-600">Name</th>
                                <th class="px-4 py-2 text-left text-gray-600">Email</th>
                                <th class="px-4 py-2 text-left text-gray-600">Phone</th>
                                <th class="px-4 py-2 text-center text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($suppliers as $supplier)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $supplier->name }}</td>
                                    <td class="px-4 py-2">{{ $supplier->email }}</td>
                                    <td class="px-4 py-2">{{ $supplier->phone }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <button wire:click="edit({{ $supplier->id }})" class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-bold py-1 px-2 rounded mr-1">
                                            Edit
                                        </button>
                                        <button
                                            wire:click="delete({{ $supplier->id }})"
                                            wire:confirm="Are you sure you want to delete this supplier?"
                                            class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-2 rounded">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $suppliers->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
