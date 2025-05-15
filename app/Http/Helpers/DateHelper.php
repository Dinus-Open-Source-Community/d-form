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
    public static function formatRangedDate($startDate, $endDate)
    {
        $start = $startDate instanceof Carbon ? $startDate : Carbon::parse($startDate);
        $end = $endDate instanceof Carbon ? $endDate : Carbon::parse($endDate);
        
        $result = [
            'days' => '',
            'months' => ''
        ];
        
        // Same month and year
        if ($start->month === $end->month && $start->year === $end->year) {
            if ($start->day === $end->day) {
                // Single day event
                $result['days'] = $start->day;
            } else {
                // Multi-day event in same month
                $result['days'] = $start->day . '-' . $end->day;
            }
            $result['months'] = $start->translatedFormat('F Y'); 
        } 
        // Different months or years
        else {
            $result['days'] = $start->day . ' ' . $start->translatedFormat('M') . ' - ' . 
                             $end->day . ' ' . $end->translatedFormat('M');
            
            if ($start->year !== $end->year) {
                $result['days'] .= ' ' . $start->year . '-' . $end->year;
            } else {
                $result['months'] = $start->year;
            }
        }
        
        return $result;
    }
}
