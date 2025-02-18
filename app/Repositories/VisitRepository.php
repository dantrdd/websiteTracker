<?php

namespace App\Repositories;

use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class VisitRepository implements RepositoryInterface
{
    public function create(array $data)
    {
        return Visit::query()->create($data);
    }

    public function getBetweenDates($from, $to): Collection
    {
       $query = Visit::query()
           ->whereBetween('visit_time', [$from, $to])
           ->selectRaw('page_url, COUNT(DISTINCT session_id) as unique_visits')
           ->groupBy('page_url')
           ->orderByDesc('unique_visits');

       return $query->get();
    }

    public function getSimilarVisit(string $sessionId,string $pageUrl, string $ipAddress, int $minutes = null): ?Visit
    {
        $query = Visit::query()
            ->where('session_id', $sessionId)
            ->where('page_url', $pageUrl)
            ->where('ip_address', $ipAddress);

        if ($minutes) {
            $query->where('visit_time', '>', Carbon::now()->subMinutes($minutes));
        }

        return $query->first();
    }
}