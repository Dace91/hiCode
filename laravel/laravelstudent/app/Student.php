<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'firstname',
        'name',
        'status',
        'bio',
        'published_at'
    ];

    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstname'] = ucfirst($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function scopeCurrent($query)
    {
        return $query->where('published_at', '<=', date('Y-m-d'));
    }

}
