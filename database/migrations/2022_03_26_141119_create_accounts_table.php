<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('account.table_name'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('account_no', 10)->unique();
            $table->integer('user_id')
                ->references(config('users.primary_id_column'))
                ->on(config('account.users.table'));
            $table->tinyInteger('status')
                ->default(\Osarze\Account\Models\Account::STATUS['PENDING']);
            $table->decimal('balance')->default(0);
//            $table->decimal('ledger_balance')->default(0);
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
        Schema::dropIfExists('accounts');
    }
}
