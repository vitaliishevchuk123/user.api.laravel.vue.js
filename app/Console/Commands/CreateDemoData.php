<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateDemoData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create demo data';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start creating demo data...');
        $this->call('create:positions');
        $this->call('create:demo-users', ['count' => 45]);
        $this->info("\n The demo data have been successfully created.");
    }
}
