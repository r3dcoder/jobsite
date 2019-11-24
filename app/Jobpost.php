<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobpost extends Model
{
    //
     protected $fillable = [
        'Job_title', 'Job_description', 'Salary', 'Country', 'Location',
    ];

    public function appliedlists(){
        return $this->hasMany('App\Appliedlist');
    }
    // public function appliedlists(){
    //     return $this->hasMany('App\Appliedlist');
    // }
    public function user(){
        return $this->belongsTo('App\User');
    }
    
    
}
