<?php

use App\Models\City;
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
        /***
         * Table addresses {
            id integer [primary key]
            addressable_id bigInt
            addressable_type varchar
            city_id bigInt
            district varchar
            street varchar
            phone varchar
            created_at timestamp
            updated_at timestamp
         */
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->morphs('addressable');
            $table->foreignIdFor(City::class);
            $table->string('district');
            $table->string('street');
            $table->string('phone');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
