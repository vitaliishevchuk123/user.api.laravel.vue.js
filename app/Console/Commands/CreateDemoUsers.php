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

        $manNames = ['Liam', 'Noah', 'Oliver', 'Elijah', 'James', 'William', 'Benjamin', 'Lucas', 'Henry', 'Theodore', 'Jack', 'Levi', 'Alexander', 'Jackson', 'Mateo'];
        $womanNames = ['Olivia', 'Emma', 'Charlotte', 'Amelia', 'Ava', 'Sophia', 'Isabella', 'Mia', 'Evelyn', 'Harper'];
        $allSurnames = ['Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis', 'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson', 'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin'];

        $domens = ['@gmail.com', '@ukr.ner'];
        $ids = range(1,45);
        shuffle($ids);
        foreach ($ids as $k => $i) {
            if ($i >= 1 && $i <= 26) {
                $sex = 1;
            } else {
                $sex = 2;
            }
            $surname = $allSurnames[array_rand($allSurnames)];
            if ($sex == 1) {
                $name = $manNames[array_rand($manNames)];
            }
            if ($sex == 2) {
                $name = $womanNames[array_rand($womanNames)];
            }
            $this->endNum = 0;
            $createdData = rand(5, 30);
            $updatedData = rand(1, 5);
            $phone = $this->generatePhone();
            $login = $this->generateLogin($name);

            /** @var User $user */
            $user = User::query()->firstOrCreate([
                'id' => $k + 1,
                'name' => $name,
                'surname' => $surname,
                'position_id' => rand(1, 4),
                'login' => $login,
                'email' => strtolower($login). '-' . strtolower($surname) . $domens[array_rand($domens)],
                'phone' => $phone,
                'password' => Hash::make('12345678'),
                'sex' => $sex,
                'created_at' => now()->subWeeks($createdData)->toDateTimeString(),
                'updated_at' => now()->subWeeks($updatedData)->toDateTimeString(),
            ]);
            $image = $sex === 1 ? "man-{$i}.jpeg" : "woman-{$i}.jpeg";
            $user->image()->firstOrCreate(['file_name' => $image]);
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
