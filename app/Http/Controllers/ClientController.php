<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    protected ClientService $service;

    public function __construct(ClientService $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        $clients = $this->service->getAll();
        return view('admin.clients', compact('clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'origin_url' => 'required|string|unique:clients,origin_url'
        ]);

        $this->service->create($validated);

        return redirect()->route('clients.index')->with('success', 'Client added successfully.');
    }

    public function destroy($id): RedirectResponse
    {
       $this->service->delete($id);

        return redirect()->route('clients.index')->with('success', 'Client removed successfully.');
    }
}