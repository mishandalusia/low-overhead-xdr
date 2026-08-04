<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseAction extends Model
{
    protected $fillable = [
        'alert_signature',
        'rule_id',
        'rule_description',
        'source_ip',
        'agent_name',
        'action',
        'status',
        'executed_at',
        'executed_by',
        'note',
    ];

    protected $casts = [
        'executed_at' => 'datetime',
    ];
}
