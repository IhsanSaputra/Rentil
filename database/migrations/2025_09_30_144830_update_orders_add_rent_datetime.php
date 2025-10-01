<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //public function up()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('pickup_time'); // hapus kolom lama
                $table->dateTime('start_datetime')->nullable();
                $table->dateTime('end_datetime')->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //public function down()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn(['start_datetime', 'end_datetime']);
                $table->string('pickup_time')->nullable(); // bisa sesuaikan
            });
        }

    }
};
