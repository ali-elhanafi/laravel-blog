<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'title',

            ]
        ];
    }

    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }
        return asset('storage/' . $value);
    }

//
//    public function setPostImageAttribute($value){
//        $this->attributes ['post_Image'] = asset($value) ;
//    }
public function comments(){
        return $this->hasMany(Comment::class);
}

}
