<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class ManageCategories extends Component
{
    use WithPagination;

    public $categoryId, $name, $description;
    public $isModalOpen = false;
    public $search = '';

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.categories.manage-categories', compact('categories'));
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetInputFields()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->description = '';
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $this->categoryId,
            'description' => 'nullable|string',
        ]);

        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash(
            'message',
            $this->categoryId ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil dibuat.'
        );

        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->description = $category->description;
        $this->openModal();
    }

    public function delete($id)
    {
        // Untuk keamanan, kita bisa tambahkan cek apakah kategori masih digunakan
        $category = Category::withCount('posts')->findOrFail($id);
        if ($category->posts_count > 0) {
            session()->flash('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh berita.');
            return;
        }

        $category->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
    }
}
