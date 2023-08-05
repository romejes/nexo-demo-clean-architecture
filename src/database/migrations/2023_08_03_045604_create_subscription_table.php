<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription', function (Blueprint $table) {
            $table->id();
            $table->dateTime("starts_at")->default(now());
            $table->dateTime("ends_at");
            $table->boolean("active");
            $table->dateTime("cancelled_at");
            $table->timestamps();

            $table->foreignId("lawyer_id");
            $table->foreign("lawyer_id", "fk_subscription_lawyer")
                ->on("lawyer")
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
        Schema::table("subscription", function (Blueprint $table) {
            $table->dropForeign("fk_subscription_lawyer");
        });

        Schema::dropIfExists('subscription');
    }
}
