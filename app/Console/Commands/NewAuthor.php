<?php

namespace App\Console\Commands;

use App\libraries\RoyalApps;
use Illuminate\Console\Command;

class NewAuthor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:new-author';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    private $royal_apps;
    
   
     
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->royal_apps =new RoyalApps();
        $data=array (
            'first_name' => 'Test ',
            'last_name' => 'Demo',
            'birthday' => now(),
            'biography' => 'atest',
            'gender' => 'male',
            'place_of_birth' => 'London',
        );
       $res= $this->royal_apps->storeAuthor($data);
       
       echo $res['response'];
    }
}
