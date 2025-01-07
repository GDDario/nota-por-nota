<?php

namespace Src\Infrastructure\Repositories;

use App\Models\PasswordResetToken as PasswordResetTokenModel;
use Src\Domain\Entities\PasswordResetToken;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\ValueObjects\{Email};

final class PasswordResetTokenEloquentRepository implements PasswordResetTokenRepositoryInterface
{
    private PasswordResetTokenModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new PasswordResetTokenModel();
    }

    public function findByToken(string $token): ?PasswordResetToken
    {
        $model = $this->eloquentModel->query()->where('token', $token)->first();

        return $this->hydrateEntity($model);
    }

    public function create(Email $email, string $token): PasswordResetToken
    {
        if ($oldModel = $this->eloquentModel->query()->where('email', $email)->first()) {
            $oldModel->delete();
        }
        $query = $this->eloquentModel->query();

        $expiresAt = now()->addMinutes(config('PASSWORD_RESET_TOKEN_EXPIRATION_TIME', 60))->toDateTime();

        $newModel = $query->create([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => now()
        ]);

        return $this->hydrateEntity($newModel);
    }

    private function hydrateEntity(?PasswordResetTokenModel $model): ?PasswordResetToken
    {
        if ($model === null) {
            return null;
        }

        return new PasswordResetToken(
            token: $model->token,
            email: new Email($model->email),
            expiresAt: $model->expires_at,
            createdAt: $model->created_at
        );
    }
}
