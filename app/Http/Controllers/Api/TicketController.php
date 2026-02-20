<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('category');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

         return $query->with('category')->latest()->paginate(10);

    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = Ticket::create([
            ...$request->validated(),
            'status' => 'open'
        ]);

        return response()->json($ticket, 201);
    }

    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $ticket->update($request->validated());

        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json([
            'message' => 'Chamado deletado com sucesso.'
        ]);
    }
}
