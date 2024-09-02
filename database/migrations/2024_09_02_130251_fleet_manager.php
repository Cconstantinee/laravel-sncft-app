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
        Schema::create('fleet_manager', function (Blueprint $table) {
            $table->string('rig_id');
            $table->string('rig_type'); // Could be 'locomotive' or 'wagon'
            $table->string('rig_status');
            $table->string('maintenance_status');
            $table->text('notes')->nullable();
            $table->timestamps();
    
            // Composite primary key
            $table->primary(['rig_id', 'rig_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
