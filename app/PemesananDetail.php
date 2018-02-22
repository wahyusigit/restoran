<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PemesananDetail extends Model
{
    // public $incrementing = false;
    protected $primaryKey = 'id_no_pemesanan_detail';
    protected $fillable = ['no_pemesanan','id_menu','subtotal','qty'];

    public function menu(){
    	return $this->belongsTo(Menu::class,'id_menu','id_menu');
    }
}
