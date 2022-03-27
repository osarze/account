<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('account.account_history_table'), function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('account_id')
                ->references('id')
                ->on(config('account.table_name'));
            $table->decimal('amount');
            $table->tinyInteger('transaction_type');
            $table->decimal('balance_after_transaction');
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
        Schema::dropIfExists('account_histories');
    }
}
