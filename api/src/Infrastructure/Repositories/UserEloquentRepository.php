<?php

namespace Src\Infrastructure\Repositories;

use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\Repositories\UserRepositoryInterface;
use \App\Models\User as UserModel;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class UserEloquentRepository implements UserRepositoryInterface
{
    private UserModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new UserModel();
    }

    public function create(CreateUserDTO $dto): User
    {
        $query = $this->eloquentModel->query();

        $model = $query->create([
            'uuid' => $dto->uuid,
            'name' => $dto->name,
            'username' => $dto->username,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);

        return $this->hydrateEntity($model);
    }

    private function hydrateEntity(UserModel $model): User
    {
        return new User(
            $model->id,
            new Uuid($model->uuid),
            $model->name,
            new Email($model->email),
            $model->username,
            $model->created_at,
            $model->updated_at,
            $model->deleted_at
        );
    }
}