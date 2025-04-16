<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;

class ParticipantsImport implements ToModel
{
    /**
     * @var string
     */
    private string $eventId;

    /**
     * ParticipantsImport constructor.
     *
     * @param string $eventId
     */
    public function __construct(string $eventId)
    {
        $this->eventId = $eventId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Participant([
            'event_id' => $this->eventId,
            'name' => $row[0],
            'school' => $row[1],
            'is_presence' => false,
            'presence_at' => null,
        ]);
    }
}
