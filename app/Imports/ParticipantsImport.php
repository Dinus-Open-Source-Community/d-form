<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
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
            'name' => $row['name'],
            'school' => $row['school'],
            'is_presence' => false,
            'presence_at' => null,
        ]);
    }
}
