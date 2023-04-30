<?php
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'name' => 'Cicles',
            'cognoms' => 'Sa Palomera',
            'email'=>env('SUPERADMIN_MAIL'),
            'etapa'=> null,
            'curs' =>null,
            'grup' =>null,
            'admin' => true,
            'superadmin' =>true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('users')->where('email', env('SUPERADMIN_MAIL'))->delete();
  
    }
};
