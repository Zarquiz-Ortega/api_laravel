<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Contracts\HasApiTokens;


class Blog extends Model
{
    use HasFactory;

    protected $table = 'blogs';

    protected $fillable = ['title','content','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
