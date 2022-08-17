<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string("name");
			$table->string("kra_pin");
        });
		$data = [["John Invalid", "A8900W"], ["James Invalid", "A013078900WA013078900W"], ["Brian Valid", "B013078900W"], ["Isaac Valid", "z112233445w"]];
		foreach($data as $item) {
			DB::insert("insert into employees (name, kra_pin) values (?, ?)", [$item[0], $item[1]]);
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
