<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Faker\Factory as Faker;
use Faker\Provider\Internet as Internet;
use App\Router;

class RouterDataGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'router:generate {no_of_routers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will generate random data for router';

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
        $no = $this->argument('no_of_routers');
        $arr = ['no_of_routers' => $no];
        
        $validator = Validator::make($arr, [
            'no_of_routers' => 'required|numeric|max:100000',      
        ]);

        // Send error
        if($validator->fails()) {
            $this->error($validator->messages()->first());
            exit();
        }

        // Generate routers
        $faker_array = [];
        $faker = Faker::create();
        for ($i=0; $i < $no; $i++) {
            $arr = [];
            $arr['sap_id'] = mt_rand(1000,5000000);
            $arr['type'] = $faker->randomElement(['AG1', 'CSS']);
            $arr['host_name'] = $faker->domainWord.mt_rand(1,5000);
            $arr['loopback'] = $faker->unique()->ipv4;
            $arr['mac_address'] = $faker->unique()->macAddress;
            $faker_array[] = $arr;
        }

        $collection = collect($faker_array);
        $router_chunks = $collection->chunk(1000);
        foreach($router_chunks as $router) {
            Router::insert($router->toArray());
        }

        $this->info('Routers generated successfully.');
        
    }
    
}
