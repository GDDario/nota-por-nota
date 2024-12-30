<?php

namespace Src\Infrastructure\Repositories;

use App\Models\User as UserModel;
use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class UserEloquentRepository implements UserRepositoryInterface
{
    private UserModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new UserModel();
    }

    public function findByEmail(Email $email): ?User
    {
        $query = $this->eloquentModel->query();

        $model = $query->where('email', $email)->first();

        return $this->hydrateEntity($model);
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

    private function hydrateEntity(?UserModel $model): ?User
    {
        if ($model === null) {
            return null;
        }

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
