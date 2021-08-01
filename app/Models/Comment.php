<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $table = 'comments';

    protected $fillable = [
        'blog_id',
        'email',
        'first_name',
        'last_name',
        'message',
        'status',
    ];







    public function user(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
