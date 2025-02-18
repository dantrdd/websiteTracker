<?php

namespace App\Http\Controllers;


use App\Models\Visit;
use App\Services\VisitService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VisitController extends Controller
{
    protected VisitService $service;

    public function __construct(VisitService $service)
    {
        $this->service = $service;
    }

    public function track(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'page_url' => 'required|string',
            'user_agent' => 'required|string',
            'session_id' => 'required|string'
        ]);
        $validated['ip_address'] = $request->ip();

        $visit = $this->service->create($validated);

        if ($visit instanceof Visit) {
            return response()->json(['success' => true]);
        }
        return response()->json(['message' => 'Duplicate visit ignored']);
    }

    public function showReport(Request $request): View
    {
        $from = $request->query('from', Carbon::now()->subDays(7)->toDateString());
        $to = $request->query('to', Carbon::now()->toDateString());

        $visits = $this->service->getBetweenDates($from, $to);

        return view('report', compact('visits'));
    }
}