<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSectionSetting extends Model
{
    use HasFactory;

    // protected $table = 'section_setings';
    protected $fillable = [
        'title',
        'sub_title',
    ];
}
