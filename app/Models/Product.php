<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, HasUuid;

    protected $table = "products";

    // create uuid
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    //

    protected $fillable = ['name', 'price', 'description', 'release', 'quantity', 'status', 'type', 'tags', 'cover', 'images', 'folder', 'updated_at', 'created_at'];

    public function comments()
    {
        return $this->hasMany('App\Models\Comment','p_id');
    }
}
