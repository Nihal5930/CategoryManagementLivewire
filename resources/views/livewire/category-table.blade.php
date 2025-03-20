<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-xl font-bold mb-4">Category List</h2>

    <table class="w-full border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2 border">#</th> <!-- Row number -->
                <th class="p-2 border">Name</th> <!-- Category name with full path -->
                <th class="p-2 border">Parent</th> <!-- Parent category -->
                <th class="p-2 border">Status</th> <!-- Enabled/Disabled status -->
                <th class="p-2 border">Created Date</th> <!-- New column for created date -->
                <th class="p-2 border">Actions</th> <!-- Edit & Delete buttons -->
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $index => $category)
                <tr>
                    <!-- Display auto-incremented row index -->
                    <td class="p-2 border text-center">{{ $index + 1 }}</td>

                    <!-- Display full category path -->
                    <td class="p-2 border">{{ $category->full_path }}</td>

                    <!-- Display parent category name or 'None' -->
                    <td class="p-2 border">{{ $category->parent?->name ?? 'None' }}</td>

                    <!-- Display category status -->
                    <td class="p-2 border text-center">
                        <span class="{{ $category->status == 1 ? 'text-green-500' : 'text-red-500' }}">
                            {{ $category->status == 1 ? 'Enabled' : 'Disabled' }}
                        </span>
                    </td>

                    <td class="p-2 border text-center">
                        {{ \Carbon\Carbon::parse($category->created_at)->setTimezone('Asia/Kolkata')->format('d M Y, h:i A') }}
                    </td>

                    <!-- Edit and Delete Buttons -->
                    <td class="p-2 border text-center">
                        <!-- Edit button triggers the edit function -->
                        <button wire:click="edit({{ $category->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                        <!-- Delete button triggers the delete function -->
                        <button wire:click="delete({{ $category->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    {{ $categories->links() }}
</div>
