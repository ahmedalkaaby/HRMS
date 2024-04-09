<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Driver
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property Carbon|null $dob
 * @property Carbon|null $driver_license
 * @property string|null $vehicle_type
 * @property Carbon|null $approved_at
 * @property Carbon|null $rejected_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection<Attachment> $attachments
 * @property Attachment $avatar
 */
class Driver extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'drivers';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'dob',
        'driver_license',
        'vehicle_type',
        'approved_at',
        'rejected_at',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }

    /**
     * @return HasOne
     */
    public function avatar(): HasOne
    {
        return $this->hasOne(Attachment::class)->where('attachment_type', 'avatar');
    }
}
