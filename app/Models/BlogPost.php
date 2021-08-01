<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'blog_posts';

    protected $fillable = [
        'cat_id',
        'sub_cat_id',
        'created_by',
        'title',
        'meta_title',
        'slug',
        'description',
        'images',
        'summary',
        'status'
    ];





    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'cat_id');
    }

    public function sub_category(){
        return $this->hasOne(SubCategory::class, 'id', 'sub_cat_id');
    }
}
