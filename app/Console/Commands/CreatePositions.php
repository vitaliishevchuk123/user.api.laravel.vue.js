<?php

namespace App\Console\Commands;

use App\Models\Position;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreatePositions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:positions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create positions';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start creating positions...');
        $positions = ['Security', 'Designer', 'Content manager', 'Lawyer'];
        $count = count($positions);
        $bar = $this->output->createProgressBar($count);
        foreach ($positions as $position) {
            Position::query()->firstOrCreate(['name' => $position]);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\n" . $count . ' positions have been successfully created.');
    }

    protected function generateLogin(string $value): string
    {
        $append = $this->endNum ? (string)$this->endNum : '';
        if (DB::table('users')->where('login', $value . $append)->exists()) {
            $this->endNum = rand(11111, 99999);
            return $this->generateLogin($value);
        }
        return $value . $append;
    }

    protected function generatePhone(): string
    {
        $value = '380' . array_rand(['99', '67', '98', '93']) . rand(1111111, 9999999);
        if (DB::table('users')->where('phone', $value)->exists()) {
            return $this->generatePhone();
        }
        return $value;
    }
}
