<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiosSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studios_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('start_time')->comment('time according to 24 hours duration');
            $table->tinyInteger('end_time')->comment('time according to 24 hours duration');
            $table->unsignedInteger('studio_id');
            $table->boolean('is_booked')->default(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studios_slots');
    }
}
