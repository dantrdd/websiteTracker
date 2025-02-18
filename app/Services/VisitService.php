<?php

namespace App\Services;

use App\Models\Visit;
use App\Repositories\VisitRepository;
use Illuminate\Support\Collection;

class VisitService
{
    protected VisitRepository $repository;

    public function __construct(VisitRepository $repository){
        $this->repository = $repository;
    }

    public function create(array $data): ?Visit
    {
        $pageUrl = $data['page_url'];
        $sessionId = $data['session_id'];
        $ipAddress = $data['ip_address'];

        $recentVisit = $this->repository->getSimilarVisit($sessionId, $pageUrl, $ipAddress, 30);

        if (!$recentVisit instanceof Visit) {
            return $this->repository->create($data);
        }

        return null;
    }

    public function getBetweenDates(string $from, string $to): Collection
    {
        return $this->repository->getBetweenDates($from,$to);
    }
}