<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DaftarMenu extends Model
{
    // public $incrementing = false;
    protected $primaryKey = 'id_menu';
    protected $fillable = ['nama_menu','desk_menu','jenis_menu','harga'];
}
