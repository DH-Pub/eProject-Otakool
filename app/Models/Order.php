<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'orders';

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['price', 'created_at', 'updated_at', 'note', 'status', 'cust_id', 'address', 'contact'];

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail', 'o_id');
    }

    public function customers()
    {
        return $this->belongsTo('App\Models\Customer', 'cust_id');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'p_id');
    }
}
