<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        $user = $user ?: create(\App\Models\User\User::class, ['type' => 'internal']);

        $this->actingAs($user);
        return $this;
    }
}
