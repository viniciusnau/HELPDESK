<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Ticket;

class TicketModelTest extends TestCase
{
    public function test_ticket_default_status_is_open()
    {
        $ticket = new Ticket([
            'title' => 'Teste',
            'description' => 'Teste descrição',
            'category_id' => 1,
            'created_by' => 'tester'
        ]);

        $this->assertEquals('open', $ticket->status);
    }
}

