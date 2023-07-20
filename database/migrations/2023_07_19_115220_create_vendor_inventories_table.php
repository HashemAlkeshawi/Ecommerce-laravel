<?php

use App\Models\inventory;
use App\Models\Vendor;
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
        Schema::create('vendor_inventories', function (Blueprint $table) {
            $table->foreignId('vendor_id')->constrained('vendors');
            $table->foreignId('inventory_id')->constrained('inventories');
            $table->softDeletes();
            $table->timestamps();
            $table->primary(['vendor_id', 'inventory_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_inventories');
    }
};
