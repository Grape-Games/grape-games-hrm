<?php

namespace App\Models;

use App\Scopes\GlobalRestrictionsWhereScope;
use App\Traits\RestrictTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Exception;
use Illuminate\Support\Str;


class Employee extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, RestrictTrait;

    public $incrementing = false;

    protected $keyType = 'uuid';

    protected $fillable = [
        'first_name',
        'last_name',
        'cnic',
        'father_name',
        'registration_no',
        'email_address',
        'primary_contact',
        'secondary_contact',
        'biometric_device_id',
        'enrollment_no',
        'city',
        'gender',
        'company_id',
        'designation_id',
        'biometric_device_id',
        'owner_id',
        'user_id'
    ];


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new GlobalRestrictionsWhereScope);

        static::creating(function ($model) {
            try {
                $model->id = (string) Str::uuid(); // generate uuid
                // Change id with your primary key
            } catch (Exception $e) {
                abort(500, $e->getMessage());
            }
        });
    }

    public function scopeCompanies($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }

    public function scopeEnrolled($query)
    {
        return $query->whereHas('additional', function ($q) {
            $q->whereNull('resignation_date');
        });
    }

    public function scopeWithWhereHas($query, $relation, $constraint)
    {
        return $query->whereHas($relation, $constraint)
            ->with([$relation => $constraint]);
    }

    /**
     * Get the user that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the owner that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    /**
     * Get the company that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get the designation that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }

    /**
     * Get the bank associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bank(): HasOne
    {
        return $this->hasOne(EmployeeBankDetails::class);
    }

    /**
     * Get the additional associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function additional(): HasOne
    {
        return $this->hasOne(EmployeeAdditionalInformation::class);
    }

    /**
     * Get the emergency associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function emergency(): HasOne
    {
        return $this->hasOne(EmployeeEmergencyContact::class);
    }

    /**
     * Get the biometricDevice that owns the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biometricDevice(): BelongsTo
    {
        return $this->belongsTo(BiometricDevice::class, 'biometric_device_id', 'id');
    }

    /**
     * Get the salaryFormula associated with the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function salaryFormula(): HasOne
    {
        return $this->hasOne(SalaryFormula::class, 'employee_id');
    }

    /**
     * Get all of the attendances for the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get all of the leaves for the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(EmployeeLeaves::class, 'owner_id', 'user_id');
    }

    /**
     * Get all of the materialRequest for the Employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function materialRequests(): HasMany
    {
        return $this->hasMany(MaterialRequest::class, 'employee_id', 'id');
    }
}
