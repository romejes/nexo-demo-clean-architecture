<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan', function (Blueprint $table) {
            $table->id();
            $table->string("name", 50);
            $table->decimal("price", 10, 2);
            $table->timestamps();
        });

        Schema::table("subscription", function (Blueprint $table) {
            $table->foreignId("plan_id");
            $table->foreign("plan_id", "fk_subscription_plan")
                ->on("plan")
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
            $table->dropForeign("fk_subscription_plan");
            $table->dropColumn("plan_id");
        });

        Schema::dropIfExists('plan');
    }
}
