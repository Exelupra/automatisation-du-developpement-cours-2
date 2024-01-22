<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Office extends Model
{
    protected $table = 'offices';
    protected $fillable = [
        'name',
        'address',
        'city',
        'zip_code',
        'country',
        'email',
        'phone',
        'company_id',
        'created_at',
        'updated_at',
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function isHeadOffice(): bool
    {
        return $this->company->headOffice->id === $this->id;
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address}, {$this->city}, {$this->zip_code}, {$this->country}";
    }
}
