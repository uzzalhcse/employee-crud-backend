<?php

use App\Models\Employee;
use App\Models\EmployeeInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Company::class,5)->create()->each(function ($company) {
            $employees = factory(Employee::class,15)->create([
                'company_id'=> $company->id
            ])->each(function ($employee){
                $employeeInfo = factory(EmployeeInfo::class)->make();
                $employee->employee_info()->save($employeeInfo);
            });
            $company->employees()->saveMany($employees);

        });

    }
}
