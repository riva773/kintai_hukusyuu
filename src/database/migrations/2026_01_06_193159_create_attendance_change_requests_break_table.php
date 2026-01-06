<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceChangeRequestsBreakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_change_requests_break', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attendance_change_request_id');
            $table->foreign('attendance_change_request_id', 'acr_break_id_fk')->references('id')->on('attendance_change_requests')->onDelete('cascade');
            $table->dateTime('break_in_at');
            $table->dateTime('break_out_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_attendance_change_requests_break');
    }
}
