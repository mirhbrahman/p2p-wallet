<?php

use App\Models\V1\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->onDelete('no action');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('no action');
            // TODO: setup decimal point limit
            $table->decimal('send_amount');
            $table->decimal('exchange_amount');
            $table->string('send_currency', 3);
            $table->string('exchange_currency', 3);
            $table->string('status', 20)->default(Transaction::STATUS_PENDING);
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
        Schema::dropIfExists('transactions');
    }
};
