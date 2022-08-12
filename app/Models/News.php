<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasUuid;

    protected $table = "news";

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['news_category_id', 'title', 'image', 'content', 'created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(NewsCategory::class,'news_category_id','id');
    }
}
