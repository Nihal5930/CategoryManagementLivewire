<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class CategoryTable extends Component
{
    use WithPagination; // Enables pagination for the table

    // Listens for the 'refreshTable' event to reload data
    protected $listeners = ['refreshTable' => '$refresh'];

    // Function to delete a category
    public function delete($id)
    {
        $category = Category::findOrFail($id); // Find the category by ID

        // If the deleted category has child categories, move them to the deleted category's parent
        Category::where('parent_id', $id)->update(['parent_id' => $category->parent_id]);

        $category->delete(); // Delete the category from the database

        $this->dispatch('refreshTable'); // Refresh the category table after deletion
    }

    // Function to send an edit event to the CategoryForm component
    public function edit($id)
    {
        $this->dispatch('editCategory', $id); // Send the selected category ID to the form
    }

    // Render the Livewire component view with paginated categories
    public function render()
    {
        return view('livewire.category-table', [
            'categories' => Category::orderBy('id', 'desc')->paginate(10), // Fetch categories ordered by newest first
        ]);
    }
}