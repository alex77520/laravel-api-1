<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::insert([
			[
				'name'     => 'shengtaolee',
				'email'    => 'lishengtao001@gmail.com',
				'password' => bcrypt('qweqwe'),
				'phone'    => '18601220155',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			], [
				'name'     => 'shengtaolee2',
				'email'    => 'lishengtao002@gmail.com',
				'password' => bcrypt('qweqwe'),
				'phone'    => '18601220156',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
		]);
	}
}
