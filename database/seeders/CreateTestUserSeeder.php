<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CreateTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Role::create([
        'name' => 'admin',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'user',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'expert',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'staff',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'author',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'employee',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      Role::create([
        'name' => 'support',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      $ivan = User::create([
        'email' => 'ivan@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Иван',
        'surname' => 'Прокофьеф',
        'patronymic' => 'Юрьевич',
        'gender' => '1',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/ivan.jpeg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $ivan->assignRole('admin');
      $ivan->assignRole('user');
      $ignat = User::create([
        'email' => 'ignat@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Игнат',
        'surname' => 'Скороходько',
        'patronymic' => 'Борисович',
        'gender' => '1',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/ignat.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $ignat->assignRole('user');
      $denis = User::create([
        'email' => 'denis@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Денис',
        'surname' => 'Попов',
        'patronymic' => 'Аркадьевич',
        'gender' => '0',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/denis.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $denis->assignRole('user');
      $denis->assignRole('expert');
      $denis->assignRole('staff');
      $alina = User::create([
        'email' => 'alina@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Алина',
        'surname' => 'Дурова',
        'patronymic' => 'Андреевна',
        'gender' => '2',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/alina.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $alina->assignRole('expert');
      $alina->assignRole('user');
      $lena = User::create([
        'email' => 'lena@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Елена',
        'surname' => 'Приходько',
        'patronymic' => 'Анатольевна',
        'gender' => '2',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/lena.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $lena->assignRole('expert');
      $lena->assignRole('staff');
      $karina = User::create([
        'email' => 'karina@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Карина',
        'surname' => 'Татуева',
        'patronymic' => 'Таурбековна',
        'gender' => '2',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/karina.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $karina->assignRole('staff');
      $karina->assignRole('user');
      $andrey = User::create([
        'email' => 'andry@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Андрей',
        'surname' => 'Добрословов',
        'patronymic' => 'Богданович',
        'gender' => '0',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/andrey.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $andrey->assignRole('author');
      $andrey->assignRole('user');
      $arkadiy = User::create([
        'email' => 'arkad@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Аркадий',
        'surname' => 'Бобриков',
        'patronymic' => '',
        'gender' => '1',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/arkadiy.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $arkadiy->assignRole('employee');
      $arkadiy->assignRole('user');
      $elena = User::create([
        'email' => 'elena@mail.ru',
        'password' => Hash::make('12345678'),
        'name' => 'Елена',
        'surname' => 'Пышкина',
        'patronymic' => 'Андреевна',
        'gender' => '0',
        'birth_date' => '2022/05/12',
        'avatar' => 'assets/images/avatars/elena.jpg',
        'status' => 'active',
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
        'last_activity_at' => Carbon::now(),
      ]);
      $elena->assignRole('support');
      $elena->assignRole('user');
    }

}
