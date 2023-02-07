<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
          'email' => 'user@mail.ru',
          'password' => Hash::make('12345678'),
          'name' => 'Admin',
          'surname' => 'Super',
          'patronymic' => 'Adminovich',
          'gender' => '1',
          'birth_date' => '2022/05/12',
          'avatar' => '',
          'status' => 'active',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
          'last_activity_at' => Carbon::now(),
        ]);

        Role::create([
          'name' => 'super-admin',
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now(),
        ]);

      $superAdmin->assignRole('super-admin');
    }
}
