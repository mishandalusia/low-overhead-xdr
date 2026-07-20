<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = [
        'alert_signature',
        'rule_id',
        'agent_name',
        'source_ip',
        'status',
        'updated_by',
        'assigned_to',
    ];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
