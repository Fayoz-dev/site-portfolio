<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use \App\Models\User;
class RefreshDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:reload {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the migration and seed the seeder';

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
     * @return int
     */
    public function handle()
    {

        $user_id = $this->argument("user_id");

        echo User::find($user_id);

        echo "Migrating is starting...\n";
        Artisan::call("migrate:refresh");
        echo "Migrating is ended\n";

        echo "Seeding is starting...\n";
        Artisan::call("db:seed");
        echo "Seeding is ended\n";

        return 0;
        
    }
}
