<?php

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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number');
            $table->string('borrower');
            $table->longText('remarks')->nullable();
            $table->integer('branch');
            $table->string('requestor');
            $table->integer('loan_coordinator');
            $table->integer('demotech');
            $table->integer('floodcert');
            $table->integer('pulldrive');
            $table->integer('agentapproval');
            $table->integer('screenupdated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};
