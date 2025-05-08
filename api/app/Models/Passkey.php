<?php

namespace App\Models;

use App\Support\JsonSerializer;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Webauthn\PublicKeyCredentialSource;

/**
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $credential_id
 * @property PublicKeyCredentialSource $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereCredentialId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Passkey whereUserId($value)
 *
 * @mixin \Eloquent
 */
class Passkey extends Model
{
    /** @use HasFactory<\Database\Factories\PasskeyFactory> */
    use HasFactory;

    protected $casts = [
        'data' => 'json',
    ];

    protected $fillable = ['name', 'credential_id', 'data'];

    public function data(): Attribute
    {
        return new Attribute(
            get: fn (string $value) => JsonSerializer::deserialize($value, PublicKeyCredentialSource::class),
            set: fn (PublicKeyCredentialSource $value) => [
                'credential_id' => base64_encode($value->publicKeyCredentialId),
                'data' => JsonSerializer::serialize($value),
            ],
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
