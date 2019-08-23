<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Order\Order::class, 20)->create()->each(function($order) {

            $contact = \App\Models\Client\Contact::where('client_id', $order->client_id)->first();

            $order->contacts()->attach($contact->id);

            $order->notes()->saveMany(factory(App\Models\Note::class, 2)->make());
        });
    }
}
