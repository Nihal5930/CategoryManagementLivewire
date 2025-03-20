<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    // Form fields for category creation and editing
    public $name, $status = 1, $parent_id, $category_id;
    public $isEdit = false; // Flag to check if we are editing or adding a category

    // Validation rules for form fields
    protected $rules = [
        'name' => 'required|string|max:255',
        'status' => 'required|integer',
        'parent_id' => 'nullable|exists:categories,id',
    ];

    // Listen for the 'editCategory' event from CategoryTable
    protected $listeners = ['editCategory' => 'edit'];

    // Function to create a new category
    public function save()
    {
        $this->validate(); // Validate input data

        // Create a new category in the database
        Category::create([
            'name' => $this->name,
            'status' => $this->status,
            'parent_id' => $this->parent_id
        ]);

        $this->resetForm(); // Reset form after saving
        $this->dispatch('refreshTable'); // Refresh the category table
    }

    // Function to populate form fields with existing data for editing
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Find the category by ID

        // Fill the form fields with the existing category data
        $this->category_id = $id;
        $this->name = $category->name;
        $this->status = $category->status;
        $this->parent_id = $category->parent_id;
        $this->isEdit = true; // Set edit mode to true
    }

    // Function to update an existing category
    public function update()
    {
        $this->validate(); // Validate input data

        $category = Category::findOrFail($this->category_id); // Find the category by ID
        $category->update([
            'name' => $this->name,
            'status' => $this->status,
            'parent_id' => $this->parent_id
        ]);

        $this->resetForm(); // Reset form after update
        $this->dispatch('refreshTable'); // Refresh the category table
    }

    // Reset form fields to default values
    private function resetForm()
    {
        $this->name = '';
        $this->status = 1;
        $this->parent_id = null;
        $this->category_id = null;
        $this->isEdit = false;
    }

    // Render the Livewire component view with category data
    public function render()
    {
        return view('livewire.category-form', [
            'categories' => Category::orderBy('id', 'desc')->get(),
        ]);
    }
}