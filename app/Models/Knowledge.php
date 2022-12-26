<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledge extends Model
{
    use HasFactory;

    protected $table ='knowledge';
    protected $fillable = ['title', 'description','user_id','sub_categories_id','views','tags','status'];

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_categories_id','id');
    }
}
