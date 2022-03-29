<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, UUID, InteractsWithMedia;
    public $incrementing = false;

    protected $keyType = 'uuid';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    public function scopeAdmins($query)
    {
        return $query->where('id', '!=', auth()->id())->where('role', 'admin');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the employeeAccount associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'user_id', 'id');
    }

    /**
     * Get all of the statusUpdates for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statusUpdates(): HasMany
    {
        return $this->hasMany(EmployeeSalaryStatus::class);
    }

    /**
     * Get all of the assignedCompanies for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedCompanies(): HasMany
    {
        return $this->hasMany(AssignedCompany::class, 'user_id', 'id');
    }

    /**
     * Get all of the assigner for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assigner(): HasMany
    {
        return $this->hasMany(AssignedCompany::class, 'assigned_by', 'id');
    }

    /**
     * Get all of the evaluationTypes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function evaluationTypes(): HasMany
    {
        return $this->hasMany(EvaluationType::class);
    }
}
