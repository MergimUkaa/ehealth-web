<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

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
    function random_float ($min,$max) {
        return ($min + lcg_value()*(abs($max - $min)));
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sensorData = DB::connection('cassandra')
            ->table('processed_data')
            ->where('patient_id', 102)
//            ->orderBy('created_at','asc')
            ->ALLOWFILTERING()
            ->take(1)
            ->get();
        $sensorDataArr = array();
        foreach ($sensorData as $data) {
//            $date = new Date($data['created_at']->time());
//            $data['created_at'] = $date->addHour()->format('H:i');

            $data['created_at'] = Carbon::now()->format('H:i');
            $data['min_value_measured'] = round($this->random_float(35.5, 40.5),2);
            array_push($sensorDataArr, $data);
        }
        event(new \App\Events\StreamingChart($sensorDataArr));
    }
}
