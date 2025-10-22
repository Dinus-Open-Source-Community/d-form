<?php

namespace App\Imports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Str;

class ParticipantsImport implements 
    ToModel, 
    WithHeadingRow, 
    WithValidation, 
    SkipsEmptyRows,
    SkipsOnFailure
{
    use SkipsFailures;

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
        // Normalize keys (handle both English and Indonesian headers)
        $normalizedRow = [];
        foreach ($row as $key => $value) {
            $normalizedKey = strtolower(trim($key));
            $normalizedRow[$normalizedKey] = $value;
        }

        // Get name with multiple possible headers
        $name = $normalizedRow['name'] ?? 
                $normalizedRow['nama'] ?? 
                $normalizedRow['participant_name'] ?? 
                $normalizedRow['nama_peserta'] ?? 
                null;

        // Get school with multiple possible headers
        $school = $normalizedRow['school'] ?? 
                  $normalizedRow['sekolah'] ?? 
                  $normalizedRow['asal_sekolah'] ?? 
                  $normalizedRow['institution'] ?? 
                  null;

        // Get email with multiple possible headers
        $email = $normalizedRow['email'] ?? 
                 $normalizedRow['e-mail'] ?? 
                 $normalizedRow['email_address'] ?? 
                 null;

        // Skip if name is empty
        if (empty($name)) {
            return null;
        }

        return new Participant([
            'id' => Str::uuid(), // Generate UUID
            'event_id' => $this->eventId,
            'name' => trim($name),
            'school' => $school ? trim($school) : null,
            'email' => $email ? trim($email) : null,
            'is_presence' => false,
            'presence_at' => null,
        ]);
    }

    /**
     * Validation rules for each row
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'nama' => 'required_without:name|string|max:255',
            'school' => 'nullable|string|max:255',
            'sekolah' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'e-mail' => 'nullable|email|max:255',
        ];
    }

    /**
     * Custom validation messages
     *
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'name.required' => 'Kolom Name/Nama wajib diisi',
            'nama.required_without' => 'Kolom Name/Nama wajib diisi',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'school.max' => 'Nama sekolah tidak boleh lebih dari 255 karakter',
            'email.email' => 'Format email tidak valid pada kolom :attribute',
            'e-mail.email' => 'Format email tidak valid',
        ];
    }

    /**
     * Custom attribute names for validation messages
     *
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            'name' => 'Nama',
            'nama' => 'Nama',
            'school' => 'Sekolah',
            'sekolah' => 'Sekolah',
            'email' => 'Email',
            'e-mail' => 'Email',
        ];
    }

    /**
     * Prepare data before validation
     *
     * @param array $data
     * @param int $index
     * @return array
     */
    public function prepareForValidation($data, $index)
    {
        // Normalize all keys to lowercase
        $prepared = [];
        foreach ($data as $key => $value) {
            $normalizedKey = strtolower(trim($key));
            $prepared[$normalizedKey] = is_string($value) ? trim($value) : $value;
        }
        
        return $prepared;
    }
}