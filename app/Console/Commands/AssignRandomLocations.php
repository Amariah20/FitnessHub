<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gym;
use Illuminate\Support\Arr;

class AssignRandomLocations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-random-locations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updating general location for existing gyms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $general_locations= ['north', 'east', 'south', 'west', 'central'];
        

        $gyms= Gym::all();

        foreach($gyms as $gym){
          // $random_location = Arr::random($general_locations); //getting a random value from the array general locations
          
          $index= rand(0, count($general_locations)-1);
          $random_location= $general_locations[$index];
          $gym ->update(['general_location'=> $random_location]);

        }
        $this->info ('success'); //prints message onto console
    }
}
