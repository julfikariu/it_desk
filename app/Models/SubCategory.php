<?php

namespace App\Models;

use App\Models\Knowledge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model
{
    use HasFactory;
    protected $table ='sub_categories';
    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function knowledge()
    {
        return $this->hasMany(Knowledge::class,'sub_categories_id','id');
    }



}
