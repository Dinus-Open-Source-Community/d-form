<?php

namespace App\Livewire\Client\Components;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class EventList extends Component
{
    use WithPagination;

    public $showToday = true;
    public $todayEvents = [];
    public $upcomingEvents = [];
    public $isLoading = true;
    public $hasError = false;
    public $statusCode = 200;
    
    public $search = '';
    public $categoryFilter = '';
    public $useSearchMode = false;
    public $page = 1;

    public $categories = [
        'general' => 'General',
        'programming' => 'Programming',
        'multimedia' => 'Multimedia',
        'networking' => 'Networking'
    ];

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function mount($showToday = true, $search = '', $categoryFilter = '')
    {
        $this->showToday = $showToday;
        $this->search = $search;
        $this->categoryFilter = $categoryFilter;
        $this->useSearchMode = !empty($search) || !empty($categoryFilter);
        
        if (!$this->useSearchMode) {
            $this->fetchEvents();
        } else {
            $this->isLoading = false;
        }
    }

    public function fetchEvents()
    {
        try {
            $this->isLoading = true;
            
            if ($this->showToday) {
                $this->todayEvents = Event::query()
                    ->whereDate('start_date', Carbon::today())
                    ->orderBy('start_time')
                    ->take(3)
                    ->get();
            }
            
            $this->upcomingEvents = Event::query()
                ->whereDate('start_date', '>', Carbon::today())
                ->orderBy('start_date')
                ->take(8)
                ->get();
                
            $this->hasError = false;
            $this->statusCode = 200;
        } catch (\Exception $e) {
            $this->hasError = true;
            $this->statusCode = 404;
            logger()->error('Error fetching events: ' . $e->getMessage());
        } finally {
            $this->isLoading = false;
        }
    }

    public function getFilteredEventsProperty()
    {
        try {
            $query = Event::query();

            if (!empty($this->search)) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'like', $searchTerm)
                      ->orWhere('description', 'like', $searchTerm)
                      ->orWhere('address', 'like', $searchTerm)
                      ->orWhere('division', 'like', $searchTerm);
                });
            }

            if (!empty($this->categoryFilter)) {
                $query->where('division', $this->categoryFilter);
            }

            $query->whereDate('start_date', '>=', now()->toDateString());

            return $query->orderBy('start_date', 'asc')
                        ->orderBy('start_time', 'asc')
                        ->paginate(8);
            
        } catch (\Exception $e) {
            logger()->error('Error filtering events: ' . $e->getMessage());
            return Event::whereRaw('1=0')->paginate(8);
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'categoryFilter'])) {
            $this->resetPage();
            $this->useSearchMode = !empty($this->search) || !empty($this->categoryFilter);
            
            if (!$this->useSearchMode) {
                $this->fetchEvents();
            }
        }
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->categoryFilter = '';
        $this->useSearchMode = false;
        $this->resetPage();
        $this->fetchEvents();
        $this->dispatch('filtersCleared');
    }

    public function render()
    {
        return view('livewire.client.components.event-list', [
            'events' => $this->useSearchMode ? $this->filteredEvents : null,
            'totalResults' => $this->useSearchMode ? $this->filteredEvents->total() : 0,
            'todayEvents' => $this->todayEvents,
            'upcomingEvents' => $this->upcomingEvents,
            'useSearchMode' => $this->useSearchMode,
            'isLoading' => $this->isLoading,
            'hasError' => $this->hasError,
            'statusCode' => $this->statusCode,
            'categories' => $this->categories
        ]);
    }
}