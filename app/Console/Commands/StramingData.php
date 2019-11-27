<?php

namespace App\Console\Commands;

use App\Events\ReadStreamingData;
use App\Models\Doctor;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StramingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'streaming:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reading real data processed from spark periodically';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = array();
        $query = DB::connection('cassandra')
            ->table('processed_data')
            ->where('created_at','>=', new \Cassandra\Timestamp(Carbon::now()->subMinutes(20)->timestamp))
            ->allowFiltering()
            ->get(['sensor_id']);
        foreach ($query as $item) {
            array_push($data, $item);
        }
        event(new ReadStreamingData($data));
    }
}
