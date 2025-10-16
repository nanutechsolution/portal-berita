<?php

namespace App\Livewire\Admin\Photos;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePhotos extends Component
{
    use WithPagination;

    public $search = '';

    public function delete($photoId)
    {
        $photo = Photo::find($photoId);
        if ($photo) {
            Storage::disk('public')->delete($photo->path);
            $photo->delete();
            session()->flash('message', 'Foto berhasil dihapus.');
        }
    }

    public function render()
    {
        $photos = Photo::with('post')
            ->where('caption', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(12);

        return view('livewire.admin.photos.manage-photos', compact('photos'));
    }
}
