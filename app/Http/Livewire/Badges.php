<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Badge;

class Badges extends Component
{
    public $badges, $name, $description, $icon, $criteria, $badgeId;
    public $isOpen = 0;
    
    public function render() 
    {
        $this->badges = Badge::all();
        return view('livewire.badges');
    }

    public function create()
    {
        $this->resetInputFields();
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

    private function resetInputFields()
    {
        $this->name = '';
        $this->description = '';
        $this->icon = null;
        $this->criteria = '';
        $this->badgeId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|image|max:1024',
            'criteria' => 'nullable|string',
        ]);

        Badge::updateOrCreate(['id' => $this->badgeId], [
            'title' => $this->title,
            'description' => $this->description,
            'icon' => $this->icon ? $this->icon->store('badges') : null,
            'criteria' => $this->criteria,
        ]);

        $this->closeModal();
        $this->resetInputFields();
        session()->flash('message', $this->badgeId ? 'Badge updated successfully.' : 'Badge created successfully.');
    }

    public function edit($id)
    {
        $badge = Badge::findOrFail($id);
        $this->badgeId = $badge->id;
        $this->name = $badge->name;
        $this->description = $badge->description;
        $this->icon = $badge->icon;
        $this->criteria = $badge->criteria;

        $this->openModal();
    }

    public function delete($id)
    {
        Badge::find($id)->delete();
        session()->flash('message', 'Badge deleted successfully.');
    }
}