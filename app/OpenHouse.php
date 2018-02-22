<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OpenHouse extends Model
{
    /**
     * Order the open houses.
     *
     * @param string $openHouses Contains information for an open house.
     * @return array
     */
    public function extract($openHouses)
    {
        $extracted = [];

        foreach ($openHouses as $key => $value) {
            $extracted[$key]['epoch_string'] = Carbon::parse($openHouses[$key]->event_start)->timestamp;
            $extracted[$key]['start_date']   = $this->formatDate($openHouses[$key]->event_start);
            $extracted[$key]['start_time']   = $this->formatTime($openHouses[$key]->event_start);
            $extracted[$key]['end_time']     = $this->formatTime($openHouses[$key]->event_end);
        }

        usort($extracted, array($this, "cmp"));

        return collect($extracted);
    }

    /**
     * Format the date as MMM DD, YYYY
     *
     * @param string $date The date of an open house.
     * @return string
     */
    protected function formatDate($date)
    {
        return Carbon::parse($date)->format('M j, Y');
    }

    /**
     * Format the time as HH:MM
     *
     * @param string $time The time for an open house.
     * @return string
     */
    protected function formatTime($time)
    {
        return Carbon::parse($time)->format('h:i a');
    }

    /**
     * Callback for usort
     * @return int
     */
    private function cmp($a, $b)
    {
        if ($a == $b) {
            return 0;
        }

        return ($a['epoch_string'] < $b['epoch_string']) ? -1 : 1;
    }
}
