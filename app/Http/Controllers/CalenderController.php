<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Carbon\Carbon;

class CalenderController extends Controller
{
    public function create()
    {
        return view('calculate');
    }
    public function store(Request $request)
    {
        $skip_dates = ['2023-05-29'];
        $working_hours = $this->calculate($request->start_date,$request->end_date,$skip_dates);
        return response([
            'Start Time' => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
            'End Time' => Carbon::parse($request->end_date)->format('Y-m-d H:i:s'),
            'Skip Dates' => $skip_dates,
            'Working Hours' => $working_hours
            ]);
    }


    public function calculate($start, $end, $skip_dates = [])
    {
        $start_datetime = Carbon::parse($start);
        $end_datetime = Carbon::parse($end);
        $working_hours = 0;
        $iteration = 0;
        $total_days = $start_datetime->diffInDays($end_datetime);
        while ($start_datetime <= $end_datetime) {
            if ($start_datetime->dayOfWeek !== Carbon::SUNDAY) {
                if(!in_array($start_datetime->format('Y-m-d'),$skip_dates)){
                    $office_start = $start_datetime->copy()->setHour(8)->setMinute(0)->setSecond(0);
                    $office_end = $start_datetime->copy()->setHour(17)->setMinute(0)->setSecond(0);
                    if($iteration === 0){
                        $office_start = ($start_datetime);
                    }
                    if ($iteration === $total_days) {
                        $office_end = $end_datetime;
                    }
                    $working_hours += $office_end->diffInSeconds($office_start);
                }
            }
            $start_datetime->addDay();
            $iteration++;
        }
        $hours = floor($working_hours / 3600);
        $minutes = floor(($working_hours % 3600) / 60);

        $hours = $hours<10 ? '0'.$hours : $hours;
        $minutes = $minutes<10 ? '0'.$minutes : $minutes;

        return $hours.':'.$minutes.':00';
    }
}
