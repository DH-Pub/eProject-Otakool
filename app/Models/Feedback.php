<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, HasUuid;

    protected $table = "feedback";

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['title', 'created_at', 'updated_at', 'content', 'status', 'cust_id'];

    public function customers()
    {
        return $this->belongsTo(Customer::class,'cust_id','id');
    }
}