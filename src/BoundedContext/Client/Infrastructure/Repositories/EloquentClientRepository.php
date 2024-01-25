<?php

declare(strict_types=1);

namespace Src\BoundedContext\Client\Infrastructure\Repositories;

use App\Client as EloquentClientModel;
use Src\BoundedContext\Client\Domain\Contracts\ClientRepositoryContract;
use Src\BoundedContext\Client\Domain\Client;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmail;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientEmailVerifiedDate;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientId;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientName;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientPassword;
use Src\BoundedContext\Client\Domain\ValueObjects\ClientRememberToken;

final class EloquentClientRepository implements ClientRepositoryContract
{
    private $eloquentClientModel;

    public function __construct()
    {
        $this->eloquentClientModel = new EloquentClientModel;
    }

    public function find(ClientId $id): ?Client
    {
        $user = $this->eloquentClientModel->findOrFail($id->value());

        // Return Domain Client model
        return new Client(
            new ClientName($user->name),
            new ClientEmail($user->email),
            new ClientEmailVerifiedDate($user->email_verified_at),
            new ClientPassword($user->password),
            new ClientRememberToken($user->remember_token)
        );
    }

    public function findByCriteria(ClientName $name, ClientEmail $email): ?Client
    {
        $user = $this->eloquentClientModel
            ->where('name', $name->value())
            ->where('email', $email->value())
            ->firstOrFail();

        // Return Domain Client model
        return new Client(
            new ClientName($user->name),
            new ClientEmail($user->email),
            new ClientEmailVerifiedDate($user->email_verified_at),
            new ClientPassword($user->password),
            new ClientRememberToken($user->remember_token)
        );
    }

    public function save(Client $user): void
    {
        $newClient = $this->eloquentClientModel;

        $data = [
            'name'              => $user->name()->value(),
            'email'             => $user->email()->value(),
            'email_verified_at' => $user->emailVerifiedDate()->value(),
            'password'          => $user->password()->value(),
            'remember_token'    => $user->rememberToken()->value(),
        ];

        $newClient->create($data);
    }

    public function update(ClientId $id, Client $user): void
    {
        $userToUpdate = $this->eloquentClientModel;

        $data = [
            'name'  => $user->name()->value(),
            'email' => $user->email()->value(),
        ];

        $userToUpdate
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
