<?php

namespace Src\Infrastructure\Repositories;

use App\Models\EmailUpdateToken as EmailResetTokenModel;
use Src\Domain\Entities\EmailUpdateToken;
use Src\Domain\Repositories\EmailUpdateTokenRepositoryInterface;
use Src\Domain\ValueObjects\{Email};

final class EmailUpdateTokenEloquentRepository implements EmailUpdateTokenRepositoryInterface
{
    private EmailResetTokenModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new EmailResetTokenModel();
    }

    public function findByToken(string $token): ?EmailUpdateToken
    {
        $model = $this->eloquentModel->query()->where('token', $token)->first();

        return $this->hydrateEntity($model);
    }

    public function create(Email $email, string $token): EmailUpdateToken
    {
        if ($oldModel = $this->eloquentModel->query()->where('email', $email)->first()) {
            $oldModel->delete();
        }
        $query = $this->eloquentModel->query();

        $expiresAt = now()->addMinutes(config('PASSWORD_RESET_TOKEN_EXPIRATION_TIME', 60))->toDateTime();

        $newModel = $query->create([
            'email'      => $email,
            'token'      => $token,
            'expires_at' => $expiresAt,
            'created_at' => now(),
        ]);

        return $this->hydrateEntity($newModel);
    }

    public function deleteByToken(string $token): bool
    {
          if (!$model = $this->eloquentModel->query()->where('token', $token)->first()) {
              return false;
          }

          return $model->delete();
    }

    public function existByToken(string $token): bool
    {
        return $this->eloquentModel->query()->where('token', $token)->exists();
    }

    private function hydrateEntity(?EmailResetTokenModel $model): ?EmailUpdateToken
    {
        if ($model === null) {
            return null;
        }

        return new EmailUpdateToken(
            token: $model->token,
            email: new Email($model->email),
            expiresAt: $model->expires_at,
            createdAt: $model->created_at
        );
    }
}
