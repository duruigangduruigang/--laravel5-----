<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

      User::create([
      	'id'	=>	'1',
      	'admin' =>	'1',
        'name'  => '寂寞的瘦子',
        'email' => 'jimoshouzi@163.com',
        'password'	=> Hash::make('jimoshouzi'),
      ]);
  }
}