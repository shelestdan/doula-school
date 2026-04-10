<?php

namespace App\Livewire;

use App\Domain\Courses\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseFilter extends Component
{
    use WithPagination;

    public string $search = '';
    public string $level  = '';
    public string $sort   = 'featured';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedLevel(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Course::published();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('short_desc', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->level) {
            $query->where('level', $this->level);
        }

        $query = match ($this->sort) {
            'price_asc'  => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'new'        => $query->orderByDesc('created_at'),
            default      => $query->orderByDesc('is_featured')->orderBy('sort_order'),
        };

        $courses = $query->paginate(9);

        return view('livewire.course-filter', compact('courses'));
    }
}
