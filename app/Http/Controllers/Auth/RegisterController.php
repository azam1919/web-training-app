<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Models\Admin;
use App\Models\Employee;
use App\Models\EmployeeLedger;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(EmployeeController::class)->main();
            return $next($request);
        });
    }
    public function create_user(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            $roles =  Role::where([['id', '!=', 1], ['id', '!=', 3]])->get();
            return view('admin.user.create')->with(['roles' => $roles]);
        } elseif (FacadesRequest::isMethod('post')) {
            $request->validate(
                [
                    'full_name' => 'required|string|min:3|max:255',
                    'user_name' => 'required|string|min:3|max:255',
                    'email' => 'required|string|email|max:255',
                    'password' => 'required|string|min:3|max:255',
                    'designation' => 'required|string|min:3|max:255',
                ],
                [
                    'full_name.required' => '*required',
                    'user_name.required' => '*required',
                    'email.required' => '*required',
                    'password.required' => '*required',
                    'designation.required' => '*required',
                ]
            );
            $full_name = $request->full_name;
            $user_name = $request->user_name;
            $email = $request->email;
            $password = $request->password;
            $Roll = $request->Roll;
            $designation = $request->designation;
            $Hashpassword = Hash::make($password);
            $token = bin2hex(random_bytes(15));
            $users_count = User::where('email', '=', $email)
                ->count();
            if ($users_count > 0) {
                return back()->with('failed', "email already Exist");
            } else {
                if ($password != '') {
                    User::insert([
                        'user_cat' => '1',
                        'r_id' => $Roll,
                        'full_name' => $full_name,
                        'user_name' => $user_name,
                        'email' => $email,
                        'password' => $Hashpassword,
                        'designation' => $designation,
                        'token' => $token,
                        'status' => '0',

                    ]);
                    $users =  User::get();
                    return redirect('/admin/user/index')->with(['users' => $users]);
                }
            }
        } else {
        }
    }
    public function create_employee(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            $RolesList =  Role::get();
            return view('admin.employee.create', ['RolesList' => $RolesList]);
        } elseif (FacadesRequest::isMethod('post')) {
            $request->validate(
                [
                    'first_name' => 'required|string|min:3|max:255',
                    'last_name' => 'required|string|min:3|max:255',
                    'father_name' => 'required|string|min:3|max:255',
                    'number' => 'required|min:3|max:255',
                    'em_number' => 'required|string|min:3|max:255',
                    'whatsapp' => 'required|string|min:3|max:255',
                    'cnic' => 'required|string|min:3|max:255',
                    'address' => 'required|string|min:3|max:255',
                    'city' => 'required|string|min:3|max:255',
                    'country' => 'required|string|min:3|max:255',
                    'email' => 'required|string|email|max:255',
                    'password' => 'required|string|min:3|max:255',
                    'type' => 'required|string|min:3|max:255',
                    'position' => 'required',
                    'department' => 'required',
                    'salary' => 'required',
                ],
                [
                    'first_name.required' => '*required',
                    'last_name.required' => '*required',
                    'father_name.required' => '*required',
                    'number.required' => '*required',
                    'em_number.required' => '*required',
                    'whatsapp.required' => '*required',
                    'cnic.required' => '*required',
                    'address.required' => '*required',
                    'city.required' => '*required',
                    'country.required' => '*required',
                    'email.required' => '*required',
                    'password.required' => '*required',
                    'type.required' => '*required',
                    'position.required' => '*required',
                    'department.required' => '*required',
                    'salary.required' => '*required',
                ]
            );
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $father_name = $request->father_name;
            $number = $request->number;
            $em_number = $request->em_number;
            $whatsapp = $request->whatsapp;
            $cnic = $request->cnic;
            $address = $request->address;
            $city = $request->city;
            $country = $request->country;
            $email = $request->email;
            $password = $request->password;
            $degree = $request->degree;
            $year = $request->year;
            $institute = $request->institute;
            $p_type = $request->p_type;
            $p_position = $request->p_position;
            $p_salary = $request->p_salary;
            $from_p_duration = $request->from_p_duration;
            $to_p_duration = $request->to_p_duration;
            $type = $request->type;
            $position = $request->position;
            $department = $request->department;
            $salary = $request->salary;
            $s_name = $request->s_name;
            $s_level = $request->s_level;
            $shift_start = $request->shift_start;
            $shift_end = $request->shift_end;
            $company = $request->company;
            $Pastjobcounts = count($p_type);
            $Skillscounts = count($s_name);
            $Educationcounts = count($degree);
            $Hashpassword = Hash::make($password);
            $token = bin2hex(random_bytes(15));
            $users_count = Employee::where('email', '=', $email)
                ->count();
            if ($users_count > 0) {
                return back()->with('failed', "email already Exist");
            } else {
                if ($password != '') {
                    Employee::insert([
                        'r_id' => 3,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'father_name' => $father_name,
                        'number' => $number,
                        'em_number' => $em_number,
                        'whatsapp' => $whatsapp,
                        'cnic' => $cnic,
                        'address' => $address,
                        'city' => $city,
                        'country' => $country,
                        'email' => $email,
                        'password' => $Hashpassword,
                        'type' => $type,
                        'position' => $position,
                        'department' => $department,
                        'salary' => $salary,
                        'shift_start' => $shift_start,
                        'shift_end' => $shift_end,
                        'company' => $company,
                        'image' => 'Dummy_Profile_Image.jpg',
                        'token' => $token,
                        'status' => 0,
                    ]);
                    $Lastinsertid = DB::getPdo()->lastInsertId();
                    EmployeeLedger::insert([
                        'e_id' => $Lastinsertid,
                        'naration' => 'Salary',
                        'debit' => '0',
                        'type' => 0,
                    ]);
                    EmployeeLedger::where('e_id', $Lastinsertid)->insert([
                        'credit' => $salary,
                    ]);
                    for ($i = 0; $i < $Pastjobcounts; $i++) {
                        $ForPastJob = DB::insert("INSERT INTO `employee_pastjob`(`E_ID`, `PType`, `PPosition`, `PSalary`, `FromPDuration`,`ToPDuration`)
                        VALUES ('$Lastinsertid','" . $p_type[$i] . "','" . $p_position[$i] . "','" . $p_salary[$i] . "','" . $from_p_duration[$i] . "','" . $to_p_duration[$i] . "') ");
                    }
                    for ($j = 0; $j < $Skillscounts; $j++) {
                        $ForSkills = DB::insert("INSERT INTO `employee_skills`(`E_ID`, `Skill_Name`, `Skill_Level`)
                    VALUES ('$Lastinsertid','" . $s_name[$j] . "','" . $s_level[$j] . "')");
                    }
                    for ($k = 0; $k < $Educationcounts; $k++) {
                        $Foreducation = DB::insert("INSERT INTO `education`(`E_ID`, `degree`, `year`, `institute`)
                    VALUES ('$Lastinsertid','" . $degree[$k] . "','" . $year[$k] . "','" . $institute[$k] . "')");
                    }
                    $EmployeeList = Employee::get();
                    $PendingEmployeeList = Employee::where('Position', 'Non-Permanent')->get();
                    $AcitveEmployeeList = Employee::where('status', 1)->get();
                    $AcitveAdminList = Role::whereHas('users', function ($query) {
                        $query->where('status', 1);
                    })->with('users')->get();
                    $Employeecount = $EmployeeList->count();
                    $AcitveEmployeecounts = $AcitveEmployeeList->count();
                    $AcitveAdminEmployeecount = User::where('status', 1)->count();
                    $AcitveEmployeecount = $AcitveEmployeecounts + $AcitveAdminEmployeecount;
                    $PendingEmployeecount = $PendingEmployeeList->count();
                    return redirect('admin/Employee')->with(['EmployeeList' => $EmployeeList, 'PendingEmployeeList' => $PendingEmployeeList, 'AcitveAdminList' => $AcitveAdminList, 'AcitveEmployeeList' => $AcitveEmployeeList, 'AcitveEmployeecount' => $AcitveEmployeecount, 'PendingEmployeecount' => $PendingEmployeecount, 'Employeecount' => $Employeecount]);
                }
            }
        } else {
        }
    }
}
