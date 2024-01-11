<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Gym;
use Illuminate\Support\Str;

//updating slugs for previous gyms
class UpdateSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-slugs';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'updating slugs for previous gyms';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $gyms= Gym::all();
        foreach($gyms as $gym){
            $slug= Str::slug($gym->name.'-'.$gym->location);
            $gym->update(['slug'=>$slug]);
        }
        $this->info ('success'); //prints message onto console

    }
}
