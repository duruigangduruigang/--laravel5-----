<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder {

  public function run()
  {
    DB::table('categories')->delete();

      Category::create([
      	'id'	=>	'1',
        'name'   => '旅行',
        'color'    => '202, 60, 60',
      ]);
  }
}