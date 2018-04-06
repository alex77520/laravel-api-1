<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneWeixinToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			$table->string('phone', 20)->unique()->nullable()->after('password');
			$table->string('weixin_openid')->unique()->nullable()->after('phone');
			$table->string('weixin_unionid')->unique()->nullable()->after('weixin_openid');
			$table->string('avatar')->nullable()->after('weixin_unionid');
			$table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users', function (Blueprint $table) {
			$table->dropColumn('phone');
			$table->dropColumn('weixin_openid');
			$table->dropColumn('weixin_unionid');
			$table->dropColumn('avatar');
			$table->string('password')->nullable(false)->change();
        });
    }
}
