<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Supplier Management</h2>

            </div>
            @if (session()->has('message'))
                <script>

                    document.addEventListener('DOMContentLoaded', function() {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        });
                        Toast.fire({
                            icon: 'success',
                            title: "{{ session('message') }}"
                        });
                    });
                </script>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-6">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ $isEditMode ? 'Edit Supplier' : 'Add New Supplier' }}
                        </h3>
                    </div>

                    <div class="p-6">
                        <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">

                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                <input wire:model="name" type="text"
                                    class="w-full rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 shadow-sm transition duration-200 ease-in-out">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                                <input wire:model="email" type="email"
                                    class="w-full rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 shadow-sm transition duration-200 ease-in-out">
                                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-5">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input wire:model="phone" type="text"
                                    class="w-full rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 shadow-sm transition duration-200 ease-in-out">
                                    @error('phone')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea wire:model="address" rows="3"
                                    class="w-full rounded-lg border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 shadow-sm transition duration-200 ease-in-out"></textarea>
                                    @error('address')<span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex items-center gap-3">
                                <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md hover:shadow-lg focus:outline-none focus:ring-0 transition-all duration-200">
                                    {{ $isEditMode ? 'Update Supplier' : 'Save Supplier' }}
                                </button>

                                @if($isEditMode)
                                    <button wire:click="cancel" type="button" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold py-2.5 px-4 rounded-lg shadow-sm focus:outline-none focus:ring-0 transition-all duration-200">
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800">Suppliers</h3>
                        <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $suppliers->total() }} Records</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Info</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($suppliers as $supplier)
                                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-bold text-lg">
                                                    {{ substr($supplier->name, 0, 1) }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $supplier->name }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $supplier->email }}</div>
                                            <div class="text-sm text-gray-500">{{ $supplier->phone ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 truncate max-w-xs" title="{{ $supplier->address }}">
                                                {{ Str::limit($supplier->address, 40) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end gap-2">
                                                <button wire:click="edit({{ $supplier->id }})" class="text-indigo-600 hover:text-indigo-900 p-2 hover:bg-indigo-50 rounded-full transition" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2-2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </button>

                                                <button
                                                    onclick="confirmDelete({{ $supplier->id }})"
                                                    class="text-red-600 hover:text-red-900 p-2 hover:bg-red-50 rounded-full transition" title="Delete">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <p class="mt-2 text-sm font-medium">No suppliers found.</p>
                                            <p class="text-xs">Get started by adding a new supplier.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
                        {{ $suppliers->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                @this.call('delete', id);
            }
        })
    }
</script>
