<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPekerjaan extends Model {
    use HasFactory, HasUuids;

    protected $table = 'data_pekerjaan';

    protected $primaryKey = 'id_data_pekerjaan';

    
}
