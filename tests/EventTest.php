<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EventTest extends TestCase
{
    /**
     * Test event list
     *
     * @return void
     */
    public function testGetAll()
    {
        $this->json('GET', '/api/events')
            ->seeJsonStructure([
                '*' => ['id', 'latitude', 'longitude']
            ]);
    }

    /**
     * Test event details
     *
     * @return void
     */
    public function testGetDetails()
    {
        $this->json('GET', '/api/events/1')
            ->seeJsonStructure(['id', 'name', 'description', 'address', 'start_date', 'end_date', 'stands', 'stands_reserved']);
    }

    /**
     * Test event detail value
     *
     * @return void
     */
    public function testGetDetailsValue()
    {
        $this->json('GET', '/api/events/1')
            ->seeJson([
                'name' => 'Event 1'
            ]);
    }

    /**
     * Test stands of a event
     *
     * @return void
     */
    public function testGetStands()
    {
        $this->json('GET', '/api/events/1/stands')
            ->seeJsonStructure([
                '*' => ['id', 'status', 'price', 'company_id']
            ]);
    }
}
