<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;



    protected $table = 'sub_categories';

    protected $fillable =[
        'cat_id',
        'subcat_name',
        'subcat_meta_title',
        'slug',
        'status',
        'created_by'
    ];




    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }
}
