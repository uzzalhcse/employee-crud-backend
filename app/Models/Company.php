<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function employees(){
        return $this->hasMany(Employee::class);
    }
}
