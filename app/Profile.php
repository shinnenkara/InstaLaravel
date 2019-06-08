<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profileImage()
    {
        $image_path = ($this->image) ? $this->image : 'uploads/ZQkbDMnVLCGbSEZw8kKTN9Wf6ih1oTe7vfqsQnEj.png';
        //127.0.0.1:8000/storage/uploads/ZQkbDMnVLCGbSEZw8kKTN9Wf6ih1oTe7vfqsQnEj.png
        return '/storage/' . $image_path;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
