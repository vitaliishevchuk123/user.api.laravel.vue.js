<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateDemoUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo-users {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make demo users';

    private int $endNum = 0;
    private bool $sexStatus = false;


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Start creating users...');
        $count = $this->argument('count');
        if (empty($count)) {
            $this->error('Count fo user is not defined!');
        }
        $bar = $this->output->createProgressBar($count);

        $manNames = ['Vasyl', 'Andrey', 'Vladimir', 'Petro', 'Fedir', 'Maxim', 'Vitalii',
            'Oleg', 'Valerii', 'Sergiy', 'Ivan', 'Alexander', 'Anatoliy'];
        $manSurnames = ['Poroshenko', 'Shevchuk', 'Polishchuk', 'Voytyuk', 'Hare', 'Vovk',
            'Rudnik', 'Likhvan', 'Nishchyt', 'Kovalchuk', 'Dmytruk', 'Mushroom', 'Piven', 'Zelenskyi'];
        $womanNames = ['Lisa', 'Olga', 'Maria', 'Ruslana', 'Olga', 'Anna', 'Viktoria'];
        $womanSurnames = ['Poroshenko', 'Osooka', 'Polova', 'Snake', 'Hare', 'Fox',
            'Mouse', 'Harna', 'Nischyt', 'Kovalchuk', 'Lisova', 'Damoy', 'Rooster', 'Zelenska'];

        $logins = ['rambo', 'otaman', 'soso', 'batman', 'animal', 'potato',
            'champion', 'fighter', 'rabbit', 'salo', 'captain', 'hulk', 'thanos'];
        $domens = ['@gmail.com', '@ukr.ner'];

        for ($i = 1; $i <= $count; $i++) {
            $sex = rand(0, 2);
            if ($sex == 1) {
                $name = $manNames[array_rand($manNames)];
                $surnames = $manSurnames[array_rand($manSurnames)];
            }
            if ($sex == 0) {
                $sex = null;
                $name = $this->sexStatus ? $womanNames[array_rand($womanNames)] : $manNames[array_rand($womanNames)];
                $surnames = $this->sexStatus ? $womanSurnames[array_rand($womanSurnames)] : $manSurnames[array_rand($womanSurnames)];
                $this->sexStatus = !$this->sexStatus;
            }

            if ($sex == 2) {
                $name = $womanNames[array_rand($womanNames)];
                $surnames = $womanSurnames[array_rand($womanSurnames)];
            }
            $this->endNum = 0;
            $createdData = rand(5, 30);
            $updatedData = rand(1, 5);
            $login = $this->generateLogin($logins[array_rand($logins)]);
            $phone = $this->generatePhone();

            /** @var User $user */
            $user = User::query()->firstOrCreate([
                'name' => $name,
                'surname' => $surnames,
                'position_id' => rand(1, 4),
                'login' => $login,
                'email' => $login . $domens[array_rand($domens)],
                'phone' => $phone,
                'password' => Hash::make('12345678'),
                'sex' => $sex,
                'created_at' => now()->subWeeks($createdData)->toDateTimeString(),
                'updated_at' => now()->subWeeks($updatedData)->toDateTimeString(),
            ]);
            $user->image()->firstOrCreate(['file_name' => "white-{$i}.jpeg"]);
            $bar->advance();
        }
        $bar->finish();
        $this->info("\n" . $count . ' users have been successfully created.');
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
        $nums = ['99', '67', '98', '93'];
        $value = '380' . $nums[rand(0,3)] . rand(1111111, 9999999);
        if (DB::table('users')->where('phone', $value)->exists()) {
            return $this->generatePhone();
        }
        return $value;
    }
}
