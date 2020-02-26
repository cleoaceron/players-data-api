<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\AbstractBaseModel;

class Player extends AbstractBaseModel
{
    const SORT = 'created_at';

    const FIELDS = [
        'uuid',
        'player_id',
        'first_name',
        'second_name',
        'form',
        'total_points',
        'influence',
        'creativity',
        'threat',
        'ict_index'
    ];

    protected $fillable = [
        'uuid',
        'player_id',
        'first_name',
        'second_name',
        'form',
        'total_points',
        'influence',
        'creativity',
        'threat',
        'ict_index'
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];
}