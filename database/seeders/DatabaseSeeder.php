<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\TestType;
use App\Models\ProductType;
use App\Models\ProductTestRequirement;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Departments
        $depts = [
            'IT' => 'Information Technology & System Admin',
            'ELECTRICAL' => 'Electrical Engineering & Testing',
            'MECHANICAL' => 'Mechanical Testing & Quality',
            'THERMAL' => 'Thermal Performance Lab',
            'QUALITY' => 'Final Quality Control'
        ];

        foreach ($depts as $name => $desc) {
            Department::updateOrCreate(['name' => $name], ['description' => $desc]);
        }

        $itDept = Department::where('name', 'IT')->first();
        $elecDept = Department::where('name', 'ELECTRICAL')->first();
        $mechDept = Department::where('name', 'MECHANICAL')->first();
        $thermDept = Department::where('name', 'THERMAL')->first();
        $qualDept = Department::where('name', 'QUALITY')->first();

        // 2. Create Users
        User::updateOrCreate(['username' => 'admin'], [
            'name' => 'Administrator',
            'full_name' => 'System Administrator',
            'user_type' => 'admin',
            'department' => 'IT',
            'department_id' => $itDept->id,
            'is_active' => true,
            'password' => Hash::make('admin123'),
        ]);

        User::updateOrCreate(['username' => 'tester'], [
            'name' => 'Electrical Tester',
            'full_name' => 'Standard Tester',
            'user_type' => 'tester',
            'department' => 'ELECTRICAL',
            'department_id' => $elecDept->id,
            'is_active' => true,
            'password' => Hash::make('test123'),
        ]);

        // 3. Create Test Types
        $tests = [
            'HV-TEST' => 'High Voltage Test',
            'INS-RES' => 'Insulation Resistance',
            'MECH-OP' => 'Mechanical Operation',
            'TEMP-RISE' => 'Temperature Rise',
            'VISUAL' => 'Visual Inspection'
        ];

        foreach ($tests as $code => $name) {
            TestType::updateOrCreate(['test_code' => $code], ['test_name' => $name]);
        }

        // 4. Create Product Types
        $productTypes = [
            'Switch Gear' => 'SG',
            'Fuse' => 'FS',
            'Capacitor' => 'CP'
        ];

        foreach ($productTypes as $name => $prefix) {
            ProductType::updateOrCreate(['name' => $name], ['prefix' => $prefix]);
        }

        // 5. Link Test Requirements
        $sg = ProductType::where('name', 'Switch Gear')->first();
        $fs = ProductType::where('name', 'Fuse')->first();
        $cp = ProductType::where('name', 'Capacitor')->first();

        $hv = TestType::where('test_code', 'HV-TEST')->first();
        $ins = TestType::where('test_code', 'INS-RES')->first();
        $mech = TestType::where('test_code', 'MECH-OP')->first();
        $temp = TestType::where('test_code', 'TEMP-RISE')->first();
        $vis = TestType::where('test_code', 'VISUAL')->first();

        // Switch Gear requirements: HV (Elec), Mech (Mech), Visual (Qual)
        ProductTestRequirement::updateOrCreate(['product_type_id' => $sg->id, 'test_type_id' => $hv->id], ['department_id' => $elecDept->id]);
        ProductTestRequirement::updateOrCreate(['product_type_id' => $sg->id, 'test_type_id' => $mech->id], ['department_id' => $mechDept->id]);
        ProductTestRequirement::updateOrCreate(['product_type_id' => $sg->id, 'test_type_id' => $vis->id], ['department_id' => $qualDept->id]);

        // Fuse requirements: Temp (Therm), Visual (Qual)
        ProductTestRequirement::updateOrCreate(['product_type_id' => $fs->id, 'test_type_id' => $temp->id], ['department_id' => $thermDept->id]);
        ProductTestRequirement::updateOrCreate(['product_type_id' => $fs->id, 'test_type_id' => $vis->id], ['department_id' => $qualDept->id]);

        // Capacitor requirements: HV (Elec), Ins (Elec), Visual (Qual)
        ProductTestRequirement::updateOrCreate(['product_type_id' => $cp->id, 'test_type_id' => $hv->id], ['department_id' => $elecDept->id]);
        ProductTestRequirement::updateOrCreate(['product_type_id' => $cp->id, 'test_type_id' => $ins->id], ['department_id' => $elecDept->id]);
        ProductTestRequirement::updateOrCreate(['product_type_id' => $cp->id, 'test_type_id' => $vis->id], ['department_id' => $qualDept->id]);

        // Optional: $this->call(UserSeeder::class);
    }
}
