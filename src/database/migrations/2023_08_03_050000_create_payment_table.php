<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->foreignId("subscription_id")->primary();
            $table->boolean("succeeded");
            $table->dateTime("paid_at")->nullable();
            $table->timestamps();

            $table->foreign("subscription_id", "fk_payment_subscription")
                ->on("subscription")
                ->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("payment", function (Blueprint $table) {
            $table->dropForeign("fk_payment_subscription");
        });

        Schema::dropIfExists('payment');
    }
}
