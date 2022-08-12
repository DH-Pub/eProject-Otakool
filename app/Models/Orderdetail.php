<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    use HasFactory, HasUuid;

    protected $table = "orderdetails";

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['quantity', 'price', 'p_id', 'o_id', 'updated_at', 'created_at'];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'p_id');
    }

    public function orders()
    {
        return $this->belongsTo('App\Models\Order', 'o_id');
    }
}
