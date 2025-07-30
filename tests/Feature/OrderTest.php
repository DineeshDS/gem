<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     *  Test to order and check to create
     * @return void
     */
    public function test_create_a_order_via_api_and_returns_detail()
    {
        $payload = [
            "company" => "customer name",
            "item" => "item name",
            "price" => "100",
            "status" => "paid"
        ];
        $response = $this->postJson('/api/orders', $payload);
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id', 'customer_name', 'item_name', 'price', 'status'
                ]
            ]);

        $this->assertDatabaseHas('orders', [
            "customer_name" => "customer name",
            "item_name" => "item name",
            "price" => "100",
            "status" => "paid"
        ]);
    }

    /**
     * Test validation errors are working
     * @return void
     */
    public function test_returns_validation_errors_when_required_fields_are_missing()
    {
        $response = $this->postJson('/api/orders', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'company',
                'item',
                'price',
                'status'
            ]);
    }

    /**
     * Test validation working for status email
     * @return void
     */
    public function test_status_validation_message_trigger()
    {
        $payload = [
            "company" => "customer name",
            "item" => "item name",
            "price" => "100"
        ];
        $response = $this->postJson('/api/orders', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'status'
            ]);
    }

    /**
     * Get order and get a single order data
     * @return void
     */
    public function test_create_order_and_get_single_order()
    {
        $postResponse = $this->postJson('/api/orders', [
            "company" => "customer name",
            "item" => "item name",
            "price" => "100",
            "status" => "paid"
        ]);
        $postResponse->assertStatus(200);
        $orderId = $postResponse->json('data.id');

        // get order by id
        $getResponse = $this->getJson("/api/orders/{$orderId}");

        $getResponse->assertStatus(200)
            ->assertJsonPath('data.customer_name', 'customer name');
    }

    /**
     * Test to delete and associated order deleted
     * @return void
     */
    public function test_to_delete_order()
    {
        $order = Order::create([
            "customer_name" => "online",
            "item_name" => "sda",
            "price" => "10",
            "status" => "paid"
        ]);

        $this->assertDatabaseHas('orders', ['id' => $order->id]);

        $response = $this->deleteJson("/api/orders/{$order->id}");
        $response->assertStatus(200);

        // Assert to test both able to delete
        $this->assertDatabaseMissing('orders', ['id' => $order->id]);
    }
}
