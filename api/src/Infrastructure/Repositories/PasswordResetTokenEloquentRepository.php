<?php

namespace Src\Infrastructure\Repositories;

use App\Models\PasswordResetToken as PasswordResetTokenModel;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\ValueObjects\{Email};

final class PasswordResetTokenEloquentRepository implements PasswordResetTokenRepositoryInterface
{
    private PasswordResetTokenModel $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new PasswordResetTokenModel();
    }

    public function create(Email $email, string $token): void
    {
        if ($oldModel = $this->eloquentModel->query()->where('email', $email)->first()) {
            $oldModel->delete();
        }
        $query = $this->eloquentModel->query();

        $expiresAt = now()->addMinutes(config('PASSWORD_RESET_TOKEN_EXPIRATION_TIME', 60))->toDateTime();

        $query->create([
            'email' => $email,
            'token' => $token,
            'expires_at' => $expiresAt,
            'created_at' => now()
        ]);
    }
}
