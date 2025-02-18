<?php

namespace App\Services;

use App\Repositories\ClientRepository;
use Illuminate\Support\Collection;

class ClientService
{
    protected ClientRepository $repository;

    public function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function delete(int $id): void
    {
        $this->repository->destroy($id);
    }
}