<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemesanan extends Model
{
    use SoftDeletes;
	protected $dates = ['deleted_at'];

    public $incrementing = false;
    protected $primaryKey = 'no_pemesanan';
    protected $fillable = ['no_meja_pemesanan','tgl_pemesanan','ttl_hrg_pemesanan','status_pembayaran'];

    public function detail(){
    	return $this->hasMany(PemesananDetail::class, 'no_pemesanan','no_pemesanan');
    }
}
