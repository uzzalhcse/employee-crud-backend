<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EmployeeInfo extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['employee_id', 'birthday'];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
