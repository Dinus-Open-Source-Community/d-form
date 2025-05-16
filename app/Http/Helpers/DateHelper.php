<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format ranged date for displaying event dates
     *
     * @param string|Carbon $startDate
     * @param string|Carbon $endDate
     * @return array
     */
    // app/Http/Helpers/DateHelper.php
    public static function formatRangedDate($startDate, $endDate)
    {
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        $format = 'j F Y';

        if ($start->isSameDay($end)) {
            return [
                'date' => $start->translatedFormat($format),
                'range' => false
            ];
        }

        return [
            'date' => $start->translatedFormat($format) . ' - ' . $end->translatedFormat($format),
            'range' => true
        ];
    }

    public static function formatEventDateRange(Carbon $start, Carbon $end): array
    {
        if ($start->isSameDay($end)) {
            return [
                'date' => $start->translatedFormat('j F Y'),
                'range' => false
            ];
        }

        if ($start->month === $end->month) {
            return [
                'date' => $start->translatedFormat('j') . '-' . $end->translatedFormat('j F Y'),
                'range' => true
            ];
        }

        return [
            'date' => $start->translatedFormat('j F') . ' - ' . $end->translatedFormat('j F Y'),
            'range' => true
        ];
    }
}
