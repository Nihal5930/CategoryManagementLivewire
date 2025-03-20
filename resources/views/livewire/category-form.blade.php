<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-xl font-bold mb-4">{{ $isEdit ? 'Edit Category' : 'Add Category' }}</h2>

    <!-- Category Form -->
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="mb-4 flex gap-4">
        <!-- Name Input Field -->
        <div class="w-1/3">
            <input type="text" wire:model="name" placeholder="Category Name" class="p-2 border rounded w-full">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Parent Category Dropdown -->
        <div class="w-1/3">
            <select wire:model="parent_id" class="p-2 border rounded w-full">
                <option value="">No Parent</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->full_path }}</option>
                @endforeach
            </select>
            @error('parent_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Status Dropdown -->
        <div class="w-1/3">
            <select wire:model="status" class="p-2 border rounded w-full">
                <option value="1">Enabled</option>
                <option value="2">Disabled</option>
            </select>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            {{ $isEdit ? 'Update' : 'Add' }}
        </button>
    </form>
</div>
