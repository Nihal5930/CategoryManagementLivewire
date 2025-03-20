<div class="p-6 bg-white rounded-lg shadow-lg">
    <!-- Form title dynamically changes between "Add Category" and "Edit Category" -->
    <h2 class="text-xl font-bold mb-4">{{ $isEdit ? 'Edit Category' : 'Add Category' }}</h2>

    <!-- Category Form -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="mb-4 flex gap-4">
        <!-- Input field for category name -->
        <input type="text" wire:model="name" placeholder="Category Name" class="p-2 border rounded w-1/3">

        <!-- Dropdown to select parent category -->
        <select wire:model="parent_id" class="p-2 border rounded w-1/3">
            <option value="">No Parent</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->full_path }}</option>
            @endforeach
        </select>

        <!-- Dropdown to select category status -->
        <select wire:model="status" class="p-2 border rounded w-1/3">
            <option value="1">Enabled</option>
            <option value="2">Disabled</option>
        </select>

        <!-- Submit button changes dynamically between "Add" and "Update" -->
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            {{ $isEdit ? 'Update' : 'Add' }}
        </button>
    </form>
</div>
