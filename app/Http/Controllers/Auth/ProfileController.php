<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeController;
use App\Models\Admin;
use App\Models\Alert;
use App\Models\AlertNotification;
use App\Models\Education;
use App\Models\Employee;
use App\Models\EmployeePastJob;
use App\Models\EmployeeSkill;
use App\Models\ProfileRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToArray;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app(EmployeeController::class)->main();
            return $next($request);
        });
    }
    public function user_profile_request(Request $request)
    {
        $E_ID = $request->E_ID;
        $EmployeeList = Employee::whereHas('profile_requests', function ($query) use ($E_ID) {
            $query->where('Status', 1);
        })->with('profile_requests')->where('E_ID', $E_ID)->get();
        return view('user.request.index')->with(['EmployeeList' => $EmployeeList]);
    }
    public function admin_employees_request()
    {
        $profile_requests =  ProfileRequest::get();
        $request_status = $profile_requests->count();
        $alerts =  Employee::with('employee_alert')->get();
        // with(['employee_alert', function ($query) {
        //     $query->orderBy('id', 'DESC');
        // }])->get();
        // dd($alerts->toArray());
        // Alert::with('users')->with('employees')->orderBy('id', 'DESC')->get();
        $alert_status = $alerts->where('status', 1)->count();
        return view('admin.request.index', ['request_status' => $request_status, 'profile_requests' => $profile_requests, 'alert_status' => $alert_status]);
    }
    public function edit_admin_employees_request(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            $e_id = $request->e_id;
            $ID = $request->id;
            $profile_requests = ProfileRequest::with(['employees' => function ($q) use ($e_id) {
                $q->orderBy('id', 'DESC');
                $q->where('id', $e_id);
            }])->where('id', $ID)->get();
            return view('admin.request.edit')->with(['profile_requests' => $profile_requests]);
        } elseif (FacadesRequest::isMethod('post') && $request->accept_profile) {
            $first_name = $request->first_name;
            $last_name = $request->last_name;
            $father_name = $request->father_name;
            $number = $request->number;
            $em_number = $request->em_number;
            $whatsapp = $request->whatsapp;
            $address = $request->address;
            $city = $request->city;
            $country = $request->country;
            $password = $request->password;
            $EID = $request->e_id;
            $Hashpassword = Hash::make($password);
            $select_password = Employee::where('id', $EID)->first();
            $profile_requests =  ProfileRequest::get();
            $request_status = $profile_requests->count();
            $alert_status = Alert::where('status', 1)->count();

            if (Hash::check($password, $select_password->password) && $password != '') {
                Employee::where('id', $EID)->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'father_name' => $father_name,
                    'number' => $number,
                    'em_number' => $em_number,
                    'whatsapp' => $whatsapp,
                    'address' => $address,
                    'city' => $city,
                    'country' => $country,
                    'password' => $Hashpassword,
                ]);
                return redirect('/admin/request')->with(['request_status' => $request_status, 'profile_requests' => $profile_requests, 'alert_status' => $alert_status])->with('success', "Request Sent Successfully");
            } else {
                Employee::where('id', $EID)->update([
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'father_name' => $father_name,
                    'number' => $number,
                    'em_number' => $em_number,
                    'whatsapp' => $whatsapp,
                    'address' => $address,
                    'city' => $city,
                    'country' => $country,
                    'password' => $password,
                ]);
                ProfileRequest::where('e_id', $EID)->update([
                    'status' => 0,
                ]);
                return redirect('/admin/request')->with(['request_status' => $request_status, 'profile_requests' => $profile_requests, 'alert_status' => $alert_status])->with('success', "Request Sent Successfully");
            }
        } elseif (FacadesRequest::isMethod('post') && $request->reject_profile) {
            $id = $request->id;
            $e_id = $request->e_id;
            ProfileRequest::where([['e_id', $e_id], ['id', $id]])->update([
                'status' => 1,
            ]);
            $profile_requests =  ProfileRequest::get();
            $request_status = $profile_requests->count();
            $alert_status = Alert::where('status', 1)->count();
            return redirect('/admin/request')->with(['request_status' => $request_status, 'profile_requests' => $profile_requests, 'alert_status' => $alert_status])->with('success', "Request Sent Successfully");
        } else {
        }
    }
    public function employee_profile()
    {
        $e_id =  Session::get('e_id');
        $employees = Employee::with('educations', 'employee_skills', 'employee_past_jobs')->where('id', $e_id)->get();
        return view('user.profile.index', ['employees' => $employees]);
    }
    public function edit_employee_profile(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            $e_id =  Session::get('e_id');
            $employees = Employee::with('roles', 'educations', 'employee_skills', 'employee_past_jobs')->where('id', $e_id)->get();
            return view('user.profile.edit', ['employees' => $employees]);
        } elseif (FacadesRequest::isMethod('post')) {
            if ($request->old_image) {
                $e_id = $request->id;
                $r_id =  Session::get('r_id');
                $old_image = $request->old_image;
                if ($request->hasFile('file')) {
                    $file = $request->file('file');
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    // dd($filename);
                    $allowed =  array("gif", "jpg", "jpeg", "png");
                    if (in_array($extension, $allowed)) {
                        File::delete(public_path('Img_Assets/profileimages/' . $old_image));
                        $file->move('Img_Assets/profileimages/', $filename);
                        Employee::where('id', $e_id)->update([
                            'image' => $filename,
                        ]);
                        $employees = Employee::with('educations', 'employee_skills', 'employee_past_jobs')->where('id', $e_id)->get();
                        return redirect('/user/profile')->with(['employees' => $employees]);
                    } else {
                        return back()->with('failed', "Not Allowed this type of Extension");
                    }
                }
            } else {

                $request->validate(
                    [
                        'first_name' => 'required|string|min:3|max:255',
                        'last_name' => 'required|string|min:3|max:255',
                        'father_name' => 'required|string|min:3|max:255',
                        'number' => 'required|min:3|max:255',
                        'em_number' => 'required|string|min:3|max:255',
                        'whatsapp' => 'required|string|min:3|max:255',
                        'address' => 'required|string|min:3|max:255',
                        'city' => 'required|string|min:3|max:255',
                        'country' => 'required|string|min:3|max:255',
                        'password' => 'required|string|min:3|max:255',
                    ],
                    [
                        'first_name.required' => '*required',
                        'last_name.required' => '*required',
                        'father_name.required' => '*required',
                        'number.required' => '*required',
                        'em_number.required' => '*required',
                        'whatsapp.required' => '*required',
                        'address.required' => '*required',
                        'city.required' => '*required',
                        'country.required' => '*required',
                        'password.required' => '*required',
                    ]
                );
                $first_name = $request->first_name;
                $last_name = $request->last_name;
                $father_name = $request->father_name;
                $number = $request->number;
                $em_number = $request->em_number;
                $whatsapp = $request->whatsapp;
                $address = $request->address;
                $city = $request->city;
                $country = $request->country;
                $password = $request->password;
                $Hashpassword = Hash::make($password);
                $e_id =  Session::get('e_id');
                $select_password = Employee::where('id', $e_id)->first();
                $r_id =  Session::get('r_id');
                $employees = Employee::with('educations', 'employee_skills', 'employee_past_jobs')->where('id', $e_id)->get();
                if (Hash::check($password, $select_password->password) && $password != '') {
                    ProfileRequest::insert([
                        'e_id' => $e_id,
                        'r_id' => $r_id,
                        'r_first_name' => $first_name,
                        'r_last_name' => $last_name,
                        'r_father_name' => $father_name,
                        'r_number' => $number,
                        'r_em_number' => $em_number,
                        'r_whatsapp' => $whatsapp,
                        'r_address' => $address,
                        'r_city' => $city,
                        'r_country' => $country,
                        'r_password' => $Hashpassword,
                        'status' => 2,
                    ]);
                    return redirect('/user/profile')->with(['employees' => $employees, 'success' => "Request Sent Successfully"]);
                } else {
                    ProfileRequest::insert([
                        'e_id' => $e_id,
                        'r_id' => $r_id,
                        'r_first_name' => $first_name,
                        'r_last_name' => $last_name,
                        'r_father_name' => $father_name,
                        'r_number' => $number,
                        'r_em_number' => $em_number,
                        'r_whatsapp' => $whatsapp,
                        'r_address' => $address,
                        'r_city' => $city,
                        'r_country' => $country,
                        'r_password' => $password,
                        'status' => 2,
                    ]);
                    return redirect('/user/profile')->with(['employees' => $employees, 'success' => "Request Sent Successfully"]);
                }
            }
        } else {
            return back();
        }
    }
    public function update_employee_profile(Request $request)
    {
    }
    public function edit_employee(Request $request)
    {
        if (FacadesRequest::isMethod('get')) {
            $EID = $request->id;
            $ForEmployee = Employee::where('id', $EID)->get();
            $ForEducation = Education::where('e_id', $EID)->get();
            $ForPastJob = EmployeePastJob::where('e_id', $EID)->get();
            $ForSkills = EmployeeSkill::where('e_id', $EID)->get();
            return view('admin.employee.edit')->with(['ForEmployee' => $ForEmployee, 'ForEducation' => $ForEducation, 'ForPastJob' => $ForPastJob, 'ForSkills' => $ForSkills]);
        } elseif (FacadesRequest::isMethod('post')) {
            $EID = $request->id;
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
            $ed_id = $request->ed_id;
            $degree = $request->degree;
            $year = $request->year;
            $institute = $request->institute;
            $p_j_id = $request->p_j_id;
            $p_type = $request->p_type;
            $p_position = $request->p_position;
            $p_salary = $request->p_salary;
            $from_p_duration = $request->from_p_duration;
            $to_p_duration = $request->to_p_duration;
            $type = $request->type;
            $position = $request->position;
            $department = $request->department;
            $salary = $request->salary;
            $s_id = $request->s_id;
            $s_name = $request->s_name;
            $s_level = $request->s_level;
            $shift_start = $request->shift_start;
            $shift_end = $request->shift_end;
            $company = $request->company;
            $Pastjobcountss = count($p_type);
            $Skillscountss = count($s_name);
            $Educationcountss = count($degree);
            $selectForNewRecord = Education::where('E_ID', $EID)->get();
            $selectForNewRecordcounts = $selectForNewRecord->count();
            $selectForNewSkillRecord = EmployeeSkill::where('E_ID', $EID)->get();
            $selectForNewSkillRecordcounts = $selectForNewSkillRecord->count();
            $selectForNewPastRecord = EmployeePastJob::where('E_ID', $EID)->get();
            $selectForNewPastRecordcounts = $selectForNewPastRecord->count();
            $ForEmployeeUpdate = Employee::where('id', $EID)->update([
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
                'password' => $password,
                'type' => $type,
                'position' => $position,
                'department' => $department,
                'salary' => $salary,
                'Shift_Start' => $shift_start,
                'Shift_End' => $shift_end,
                'company' => $company,
            ]);
            for ($m = 0; $m < $selectForNewRecordcounts; $m++) {
                $ForEducationUpdate = Education::where([['e_id', $EID], ['id', $ed_id[$m]]])->update([
                    'degree' => $degree[$m],
                    'year' => $year[$m],
                    'institute' => $institute[$m],
                ]);
            }
            for ($selectForNewRecordcounts; $selectForNewRecordcounts < $Educationcountss; $selectForNewRecordcounts++) {
                Education::insert([
                    'e_id' => $EID,
                    'degree' => " . $degree[$selectForNewRecordcounts] . ",
                    'year' => " . $year[$selectForNewRecordcounts] . ",
                    'institute' => " . $institute[$selectForNewRecordcounts] . ",
                ]);
            }
            for ($n = 0; $n < $selectForNewSkillRecordcounts; $n++) {
                $ForSkillsUpdate = EmployeeSkill::where([['e_id', $EID], ['id', $s_id[$n]]])->update([
                    'name' => $s_name[$n],
                    'level' => $s_level[$n],
                ]);
                // $ForSkillsUpdate = DB::update("UPDATE `employee_skills` SET `Skill_Name`='$SName[$n]', `Skill_Level`='$SLevel[$n]'
                //      WHERE E_ID = $EID AND ID = $Skills_ID[$n]");
            }
            for ($selectForNewSkillRecordcounts; $selectForNewSkillRecordcounts < $Skillscountss; $selectForNewSkillRecordcounts++) {
                EmployeeSkill::insert([
                    'e_id' => $EID,
                    'name' => $s_name[$selectForNewSkillRecordcounts],
                    'level' => $s_level[$selectForNewSkillRecordcounts],
                ]);
                // DB::insert("INSERT INTO `employee_skills`(`E_ID`, `Skill_Name`, `Skill_Level`)
                // VALUES ('$EID','" . $SName[$selectForNewSkillRecordcounts] . "','" . $SLevel[$selectForNewSkillRecordcounts] . "')");
            }
            for ($l = 0; $l < $selectForNewPastRecordcounts; $l++) {
                $ForPastJobUpdate = EmployeePastJob::where([['e_id', $EID], ['id', $p_j_id[$l]]])->update([
                    'p_type' => $p_type[$l],
                    'p_position' => $p_position[$l],
                    'p_salary' => $p_salary[$l],
                    'from_p_duration' => $from_p_duration[$l],
                    'to_p_duration' => $to_p_duration[$l],
                ]);
                // DB::update("UPDATE `employee_pastjob` SET `PType`= '$PType[$l]', `PPosition`='$PPosition[$l]',
                //     `PSalary`='$PSalary[$l]',`FromPDuration`='$FromPDuration[$l]',`ToPDuration`='$ToPDuration[$l]' WHERE E_ID = $EID AND ID = $Past_Job_ID[$l]");
            }
            for ($selectForNewPastRecordcounts; $selectForNewPastRecordcounts < $Pastjobcountss; $selectForNewPastRecordcounts++) {
                EmployeePastJob::insert([
                    'p_type' => $p_type[$selectForNewPastRecordcounts],
                    'p_position' => $p_position[$selectForNewPastRecordcounts],
                    'p_salary' => $p_salary[$selectForNewPastRecordcounts],
                    'from_p_duration' => $from_p_duration[$selectForNewPastRecordcounts],
                    'to_p_duration' => $to_p_duration[$selectForNewPastRecordcounts],
                ]);
                // DB::insert("INSERT INTO `employee_pastjob`(`E_ID`, `PType`, `PPosition`, `PSalary`, `FromPDuration`,`ToPDuration`)
                //     VALUES ('$EID','" . $PType[$selectForNewPastRecordcounts] . "','" . $PPosition[$selectForNewPastRecordcounts] . "','" . $PSalary[$selectForNewPastRecordcounts] . "','" . $FromPDuration[$selectForNewPastRecordcounts] . "','" . $ToPDuration[$selectForNewPastRecordcounts] . "') ");
            }
            if (!$ForEmployeeUpdate || !$ForEducationUpdate || !$ForSkillsUpdate || !$ForPastJobUpdate || $ForEmployeeUpdate || $ForEducationUpdate || $ForSkillsUpdate || $ForPastJobUpdate) {
                $request->session()->flash('success', "Employee Data Updated");
            } else {
                $request->session()->flash('Failed', "Employee Data Not Updated");
            }
            $EmployeeList = Employee::get();
            return redirect('/admin/employee')->with('EmployeeList', $EmployeeList);
        } else {
        }
    }
    public function DeleteEmployee(Request $request)
    {
        $E_ID = $request->E_ID;
        Employee::where('E_ID', $E_ID)->delete();
        $EmployeeList = Employee::get();
        return redirect('/admin/Employee')->with('EmployeeList', $EmployeeList);
    }
}
