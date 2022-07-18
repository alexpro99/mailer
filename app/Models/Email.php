<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Email extends Model
{
    use HasFactory;
    use LogsActivity;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //metodo para loguear automaticamente el crud
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
