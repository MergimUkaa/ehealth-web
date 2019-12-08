<?php

namespace App\Console\Commands;

use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Jenssegers\Date\Date;
use phpDocumentor\Reflection\Location;

class StreamingChart extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streaming:chart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read realtime data for rendering on charts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    function random_float($min, $max)
    {
        return ($min + lcg_value() * (abs($max - $min)));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $patients = Patient::all()->pluck('id');
        foreach ($patients as $patientId) {
            $sensorData = DB::connection('cassandra')
                ->table('processed_data')
                ->where('patient_id', $patientId)
//            ->orderBy('created_at','asc')
                ->ALLOWFILTERING()
                ->take(1)
                ->get();

            if (!$sensorData[0])
                continue;

            $sensorDataArr = array();
            foreach ($sensorData as $data) {
//            $date = new Date($data['created_at']->time());
//            $data['created_at'] = $date->addHour()->format('H:i');

                $data['created_at'] = Carbon::now()->addHour()->format('H:i');
                $data['min_value_measured'] = round($this->random_float(40.00, 140.00), 2);
                $data['max_value_measured'] = round($this->random_float(100, 130), 2);
                array_push($sensorDataArr, $data);
            }
            event(new \App\Events\StreamingChart($sensorDataArr));
        }

    }

}
