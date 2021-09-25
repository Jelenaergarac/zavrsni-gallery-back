<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
         
       
        
        
        
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(Image::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public static function search($value = null){
        $query = self::query();

        if($value){
            $query->whereHas('user', function($query) use ($value) 
            { $query->where('title', 'like', '%'.$value.'%') 
                ->orWhere('description', 'like', '%'.$value.'%')
                ->orWhere('firstname', 'like', '%'.$value.'%')
                ->orWhere('lastname', 'like', '%'.$value.'%'); });
        }
        return $query;
        }
    }

