<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements AuditableContract
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    use Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'status',
        'first_name',
        'last_name',
        'comments',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relations
     */
    public function serviceProvider()
    {
        return $this->belongsTo(\App\Models\ServiceProvider::class);
    }

    /**
     * Scope for staff visibility logic.
     * Call this as UserProfile::visibleToMe()->get();
     */
    public function scopeVisibleToMe($query)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $tableName = $query->getQuery()->from;

            // 1. Super Admin: No provider ID = See everyone
            if (is_null($user->service_provider_id)) {
                return;
            }
            // 2. Admin: Can see all staff under their provider (including other Admins)
            if ($user->hasRole('Admin')) {
                return $query->where($tableName . '.service_provider_id', $user->service_provider_id);
                return;
            }
            // 3. Staff with Permission: See same provider, but NOT Admins
            if (!$user->hasRole('Admin') && $user->can('all_staff_account')) {
                return  $query->where($tableName . '.service_provider_id', $user->service_provider_id)
                    ->whereDoesntHave('roles', function ($q) {
                        $q->where('name', 'Admin');
                    });
                return;
            }
            // 4. Default: Only see their own profile
            return $query->where($tableName . '.id', $user->id);
        }
    }

    /**
     * Auto Deletion and global filter by Service Provider.
     */
    protected static function booted()
    {
        // WRITE automation - deleting
        static::deleting(function ($staff) {
            deleteFile($staff->profile_photo);
        });

    }

    /**
     * Get full public URL of the profile photo (or placeholder).
     */
    public function getProfilePhotoUrlAttribute()
    {
        // If profile photo exists
        if ($this->profile_photo && Storage::exists($this->profile_photo)) {
            return Storage::url($this->profile_photo);
        } else {
            // Gender-based default image
            if ($this->gender === 'Male') {
                return asset('public/profile/default-male.jpg');
            } elseif ($this->gender === 'Female') {
                return asset('public/profile/default-female.jpg');
            } else {
                return  asset('public/profile/image-holder.png');
            }
        }
    }

    /**
     * Add extra data into audit table
     */
    public function transformAudit(array $data): array
    {
        $data['service_provider_id'] = auth()->user()->service_provider_id ?? null;

        return $data;
    }
}