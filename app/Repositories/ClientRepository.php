<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Collection;

class ClientRepository implements RepositoryInterface
{
    public function create(array $data)
    {
        return Client::query()->create($data);
    }

    public function getAll(): Collection
    {
       return Client::all();
    }

    public function destroy(int $id): int
    {
        return Client::destroy($id);
    }
}