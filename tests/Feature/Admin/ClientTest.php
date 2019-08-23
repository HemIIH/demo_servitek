<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClientTest extends TestCase
{

    /** @test */
    public function can_view_profile()
    {
        $this->signIn();

        $response = $this->get('/client/1/profile');

        create(\App\Models\Client\Client::class, ['name' => 'Rheinterrassen Köln']);

        $response->assertSee('Rheinterrassen Köln');
    }
}
