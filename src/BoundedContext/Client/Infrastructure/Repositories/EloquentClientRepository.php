<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure\Repositories;

use App\Client as EloquentClientModel;
use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientCpf;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;


final class EloquentClientRepository implements ClientRepositoryContract
{
    private EloquentClientModel $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentClientModel;
    }

    public function find(ClientId $id): ?Client
    {
        $client = $this->eloquentClientModel->findOrFail($id->value());

        // Return Domain Client model
        return new Client(
            new ClientName($client->name),
            new ClientEmail($client->email),
            new ClientCpf($client->cpf)
        );
    }

    public function findByCriteria(ClientName $name, ClientEmail $email, ClientCpf $cpf): ?Client
    {
        $client = $this->eloquentClientModel
            ->where('name', $name->value())
            ->where('email', $email->value())
            ->where('cpf', $cpf->value())
            ->firstOrFail();

        // Return Domain Client model
        return new Client(
            new ClientName($client->name),
            new ClientEmail($client->email),
            new ClientCpf($client->cpf)
        );
    }

    public function save(Client $client): void
    {
        $newClient = $this->eloquentClientModel;

        $data = [
            'name' => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf' => $client->cpf()->value(),
        ];

        $newClient->create($data);
    }

    public function update(ClientId $id, Client $client): void
    {
        $clientToUpdate = $this->eloquentClientModel;

        $data = [
            'name'  => $client->name()->value(),
            'email' => $client->email()->value(),
            'cpf'   => $client->cpf()->value(),
        ];

        $clientToUpdate
            ->findOrFail($id->value())
            ->update($data);
    }

    public function delete(ClientId $id): void
    {
        $this->eloquentClientModel
            ->findOrFail($id->value())
            ->delete();
    }
}
