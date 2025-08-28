<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JudulHalaman;
use Livewire\WithPagination;

class KelolaJudulHalaman extends Component
{
    use WithPagination;

    public $judul_id;
    public $title;
    public $is_active = true;
    public $isOpen = false;
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = ['search', 'sortField', 'sortDirection'];

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'is_active' => 'boolean'
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        return view('livewire.kelola-judul-halaman', [
            'juduls' => JudulHalaman::where('judul', 'like', '%'.$this->search.'%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetFields()
    {
        $this->reset(['judul_id', 'title', 'is_active']);
    }

    public function store()
    {
        $this->validate();

        // If a judul is already active, deactivate it
        if ($this->is_active) {
            JudulHalaman::where('is_active', true)->update(['is_active' => false]);
        }

        JudulHalaman::create([
            'title' => $this->title,
            'is_active' => $this->is_active
        ]);

        $this->closeModal();
        $this->resetFields();
        
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Judul halaman berhasil dibuat!'
        ]);
    }

    public function edit($id)
    {
        $judul = JudulHalaman::findOrFail($id);
        $this->judul_id = $id;
        $this->title = $judul->title;
        $this->is_active = $judul->is_active;
        
        $this->openModal();
    }

    public function update()
    {
        $this->validate();

        $judul = JudulHalaman::find($this->judul_id);

        // If setting this judul as active, deactivate others
        if ($this->is_active && !$judul->is_active) {
            JudulHalaman::where('is_active', true)->update(['is_active' => false]);
        }

        $judul->update([
            'title' => $this->title,
            'is_active' => $this->is_active
        ]);

        $this->closeModal();
        $this->resetFields();
        
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Judul halaman berhasil diperbarui!'
        ]);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Apakah Anda yakin?',
            'text' => 'Data yang dihapus tidak dapat dikembalikan!',
            'id' => $id,
            'method' => 'deleteConfirmed'
        ]);
    }

    public function deleteConfirmed($id)
    {
        JudulHalaman::find($id)->delete();
        
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Judul halaman berhasil dihapus!'
        ]);
    }

    public function toggleActive($id)
    {
        $judul = JudulHalaman::find($id);
        
        if (!$judul->is_active) {
            // If activating this one, deactivate others
            JudulHalaman::where('is_active', true)->update(['is_active' => false]);
            $judul->update(['is_active' => true]);
            
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Judul halaman berhasil diaktifkan!'
            ]);
        } else {
            $judul->update(['is_active' => false]);
            
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Berhasil!',
                'text' => 'Judul halaman berhasil dinonaktifkan!'
            ]);
        }
    }
}
