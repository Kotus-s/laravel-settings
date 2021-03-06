<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Kotus\Settings\Database\Seeder\SettingSeeder;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', static function (Blueprint $table) {
                $table->string('key')->index();
                $table->text('value')->nullable();
                $table->string('tenant')->nullable()->index();
                $table->primary(['key', 'tenant']);
                $table->unique(['key', 'tenant']);
            });

            $seeder = new SettingSeeder();
            $seeder->run();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}
