<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id')->unsigned()->unique();
            $table->integer('project_id')->nullable();
            $table->string('order_status');
            $table->date('order_date');
            $table->text('customer_note')->nullable();
            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('billing_company')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_state_code')->nullable();
            $table->string('billing_post_code')->nullable();
            $table->string('billing_country_code')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_phone')->nullable();
            $table->string('shipping_company')->nullable();
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state_code')->nullable();
            $table->integer('shipping_post_code')->nullable();
            $table->string('shipping_country_code')->nullable();
            $table->string('item')->nullable();
            $table->json('products')->nullable();
            /*$table->integer('hyg_hg001')->nullable();
            $table->integer('typ_II')->nullable();
            $table->integer('typ_IIR')->nullable();
            $table->integer('n95_hg002')->nullable();
            $table->integer('schild_hg005')->nullable();
            $table->integer('hyg_red_masks')->nullable();
            $table->integer('door_handler')->nullable();
            $table->integer('med_einweg')->nullable();
            $table->integer('stoffmasken')->nullable();
            $table->integer('trennwand')->nullable();
            $table->integer('thermometer')->nullable();
            $table->integer('hand_disinfection')->nullable();
            $table->integer('flachendes')->nullable();
            $table->integer('hand_spender')->nullable();*/

            $table->string('shipping_method_title')->nullable();
            $table->string('order_shipping_amount')->nullable();

            $table->string('payment_method_title')->nullable();
            $table->string('coupon_code')->nullable();

            $table->string('discount_amount')->nullable();
            $table->string('discount_amount_tax')->nullable();
            $table->decimal('card_discount_amount')->nullable();

            $table->decimal('order_refund_amount')->nullable();
            $table->decimal('order_total_amount')->nullable();
            $table->decimal('order_total_tax_amount')->nullable();
            $table->string('print_status')->nullable();
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
        Schema::dropIfExists('full_orders');
    }
}
