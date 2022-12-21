<?php

namespace Tests\Unit;

use Tests\TestCase;

class DashboardUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_halaman_dashboard_access()
    {

        $this->get('/login')->assertStatus(200);
        $this->get('/home')->assertStatus(302);

    }
}
