<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageTableSeeder extends Seeder {

  public function run()
  {
    DB::table('messages')->delete();

      Message::create([
        'user_id'   => '1',
        'title'   	=> '一个寂寞的瘦子',
        'content'   => '没错，一个寂寞的瘦子。 A lonely man.',
        'category'	=>	'1',
      ]);
  }

}