<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'first_name',
        'last_name',
        'office_id',
        'email',
        'job_title',
        'created_at',
        'updated_at',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function getDisplayName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function __toString(): string
    {
        $prenomNom = "{$this->first_name} {$this->last_name}";
        $telephone = "telephone: " . ($this->phone ?? 'N/A');
        $job_title = "job title: " . ($this->job_title ?? 'N/A');
        $email = "email: " . ($this->email ?? 'N/A');
        return implode(' | ', [$prenomNom, $telephone, $job_title, $email]);
    }
}
