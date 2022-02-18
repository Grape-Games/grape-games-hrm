<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Employee extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, UUID;
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

    public $incrementing = false;

    protected $keyType = 'uuid';


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
}
