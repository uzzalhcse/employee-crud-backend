<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'company_id'];
//    protected $appends = ['company_id', 'company_name', 'birthday'];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function employee_info(){
        return $this->hasOne(EmployeeInfo::class, 'employee_id');
    }


    /**
     * Get the birthday.
     *
     * @return string
     */
    public function getBirthdayAttribute()
    {
        return $this->employee_info->birthday;
    }
}
