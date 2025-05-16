<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class EventCreateAdmin extends Component
{
    use WithFileUploads;

    public $name = '';
    public $googleFormUrl = '';
    public $registrationDate = '';
    public $eventDate = '';
    public $startTime = '';
    public $endTime = '';
    public $durationDays = 1;
    public $participants = 1;
    public $type = 'RKT';
    public $division = 'General';
    public $address = '';
    public $googleMapsUrl = '';
    public $description = '';
    public $coverEvent;
    public $showSuccessModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'googleFormUrl' => 'nullable|url',
        'registrationDate' => 'required|date',
        'eventDate' => 'required|date',
        'startTime' => 'required',
        'endTime' => 'required',
        'durationDays' => 'required|integer|min:1',
        'participants' => 'required|integer|min:1',
        'type' => 'required|in:RKT,NON-RKT',
        'division' => 'required|in:General,Programming,Multimedia,Networking',
        'address' => 'required|string',
        'googleMapsUrl' => 'nullable|url',
        'description' => 'required|string',
        'coverEvent' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'name.required' => 'The event name is required.',
        'name.max' => 'The event name cannot exceed 255 characters.',
        'googleFormUrl.url' => 'Please enter a valid Google Form URL.',
        'registrationDate.required' => 'The registration date is required.',
        'registrationDate.date' => 'Please enter a valid registration date.',
        'eventDate.required' => 'The event date is required.',
        'eventDate.date' => 'Please enter a valid event date.',
        'startTime.required' => 'The start time is required.',
        'endTime.required' => 'The end time is required.',
        'durationDays.required' => 'The duration is required.',
        'durationDays.integer' => 'The duration must be a number.',
        'durationDays.min' => 'The duration must be at least 1 day.',
        'participants.required' => 'The number of participants is required.',
        'participants.integer' => 'The number of participants must be a number.',
        'participants.min' => 'There must be at least 1 participant.',
        'type.required' => 'The event type is required.',
        'type.in' => 'Please select a valid event type (RKT or NON-RKT).',
        'division.required' => 'The division is required.',
        'division.in' => 'Please select a valid division.',
        'address.required' => 'The address is required.',
        'googleMapsUrl.url' => 'Please enter a valid Google Maps URL.',
        'description.required' => 'The description is required.',
        'coverEvent.image' => 'The uploaded file must be an image.',
        'coverEvent.max' => 'The image cannot exceed 2MB.',
    ];

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setDivision($division)
    {
        $this->division = $division;
    }

    public function createEvent()
    {
        $this->validate();

        $eventData = [
            'user_id' => Auth::id(),
            'name' => $this->name,
            'gform_url' => $this->googleFormUrl,
            'start_date' => $this->eventDate,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'duration_days' => $this->durationDays,
            'participants' => $this->participants,
            'type' => $this->type,
            'division' => $this->division,
            'address' => $this->address,
            'map_url' => $this->googleMapsUrl,
            'description' => $this->description,
        ];

        if ($this->coverEvent) {
            $path = $this->coverEvent->store('events', 'public');
            $eventData['cover_event'] = $path;
        }

        $event = Event::create($eventData);

        if ($event) {
            LivewireAlert::title('Success')
                ->text('Event created successfully!')
                ->success()
                ->withConfirmButton()
                ->onConfirm(
                    'redirectToDetail',
                    ['eventId' => $event->id],
                )
                ->show();
            
        } else {
            LivewireAlert::title('Error')
                ->text('Failed to create event.')
                ->timer(3000)
                ->error()
                ->toast()
                ->position('top-end')
                ->withOptions([
                    'timerProgressBar' => true,
                ])
                ->show();
        }

    }

    public function redirectToDetail($data)
    {
        return redirect()->route('admin.event-detail', ['eventId' => $data['eventId']]);
    }

    public function goToDashboard()
    {
        return redirect()->route('admin.dashboard');
    }

    public function closeModal()
    {
        $this->showSuccessModal = false;
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.event-create-admin');
    }
}
