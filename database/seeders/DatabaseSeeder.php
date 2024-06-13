<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\admin_account;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        admin_account::create([
            'pass'=>'pass',
            'token' =>'swogaqlHRvJg9?4k!KcgmTKmZ8jsGsi=sMksR4ikl0SfDp3LU!ELeGm3D2SHeZlulgUeP9neSPs1L-MurKYS4SaytSc7O8RxXj2MAp5Y3wpPZVmjn'
        ]);
    }

}
