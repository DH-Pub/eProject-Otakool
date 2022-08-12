<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasUuid;

    protected $table = "comments";

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['title', 'created_at', 'updated_at', 'rate', 'images', 'content', 'p_id', 'cust_id'];


    //  Foreign key
    public function customers()
    {
        return $this->belongsTo('App\Models\Customer', 'cust_id');
    }
    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'p_id');
    }
}
