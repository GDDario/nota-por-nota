<?php

namespace Src\Infrastructure\Repositories;

use App\Models\User as UserModel;
use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\ValueObjects\{Email, Uuid};

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
            'uuid'     => $dto->uuid,
            'name'     => $dto->name,
            'username' => $dto->username,
            'email'    => $dto->email,
            'password' => $dto->password,
        ]);

        return $this->hydrateEntity($model);
    }

    public function update(Email $email, ?string $name = null, ?string $username = null): ?User
    {
        if (!$model = $this->eloquentModel->query()->where('email', $email)->first()) {
            return null;
        }

        $data = [];

        if ($name) {
            $data['name'] = $name;
        }

        if ($username) {
            $data['username'] = $username;
        }

        $model->update($data);
        $model->refresh();

        return $this->hydrateEntity($model);
    }

    public function updatePassword(Email $email, string $password): ?User
    {
        if (!$model = $this->eloquentModel->query()->where('email', $email)->first()) {
            return null;
        }

        $model->update([
            'password' => $password
        ]);

        return $this->hydrateEntity($model);
    }

    public function updateEmail(Email $oldEmail, Email $newEmail): ?User
    {
        if (!$model = $this->eloquentModel->query()->where('email', $oldEmail)->first()) {
            return null;
        }

        $model->update([
            'email' => $newEmail
        ]);

        return $this->hydrateEntity($model);
    }


    public function updatePicture(Email $email, string $picture, string $originalPicture): ?User
    {
        if (!$model = $this->eloquentModel->query()->where('email', $email)->first()) {
            return null;
        }

        $model->update([
            'picture' => $picture,
            'original_picture' => $originalPicture
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
