<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Setting extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'settings';

    protected $fillable = [
        'website_name',
        'logo',
        'favicon',
        'description',
        'meta_title',
        'meta_description',
        'meta_keyword',
    ];
}
