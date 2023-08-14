<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\TestOffer;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'appointments';
        if($request->ajax()){
            $appointments = Appointment::get();
            return DataTables::of($appointments)
                ->addIndexColumn()
                ->addColumn('patient', function($row){
                    return $row->user->name ?? '';
                })
                ->addColumn('approved_by', function($row){
                    return $row->approvedBy->name ?? '';
                })
                ->addColumn('tests', function($row){
                    $test_names = array_map(function($id){
                        return TestOffer::find($id)->name ?? '';
                    },$row->test_offers);
                    return implode(',', $test_names);
                })
                ->addColumn('stat', function($row){
                    $status = $row->status;
                    $text = ($status != 1) ? "Pending": "Approved";
                    $approve = '<a data-id="'.$row->id.'" data-status="'.$status.'" href="javascript:void(0)" class="update_status"><button class="btn btn-info">'.$text.'</button></a>';
                    return $approve;
                })
                ->addColumn('action',function ($row){
                    $editbtn = '<a data-id="'.($row->id).'" data-patient="'.($row->user_id).'" data-gender="'.($row->gender).'" data-address="'.($row->address).'" data-date="'.($row->appointment_date).'" data-tests="'.json_parse($row->test_offers).'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('appointments.destroy').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    if(!auth()->user()->hasPermissionTo('edit-appointment')){
                        $editbtn = '';
                    }
                    if(!auth()->user()->hasPermissionTo('destroy-appointment')){
                        $deletebtn = '';
                    }
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['action','stat'])
                ->make(true);
        }
        $patients = User::role('patient')->get();
        $tests = TestOffer::get();
        return view('admin.appointments.index',compact(
            'title','patients','tests'
        ));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userAppointment(Request $request)
    {
        $title = 'my appointments';
        if($request->ajax()){
            return DataTables::of(auth()->user()->appointments)
                ->addIndexColumn()
                ->addColumn('patient', function($row){
                    return $row->user->name ?? '';
                })
                ->addColumn('approved_by', function($row){
                    return $row->approvedBy->name ?? '';
                })
                ->addColumn('tests', function($row){
                    $test_names = array_map(function($id){
                        return TestOffer::find($id)->name ?? '';
                    },$row->test_offers);
                    return implode(',', $test_names);

                })
                ->addColumn('status', function($row){
                    $status = $row->status;
                    $text = ($status != 1) ? "Pending": "Approved";
                    $approve = '<a data-id="'.$row->id.'" data-status="'.$status.'" href="javascript:void(0)" class="update_status"><button class="btn btn-info">'.$text.'</button></a>';
                    return $approve;
                })
                ->addColumn('date_created', function($row){
                    return date_format(date_create($row->created_at),'d M, Y');
                })
                ->rawColumns(['status'])
                ->make(true);
        }
        $patients = User::role('patient')->get();
        $tests = TestOffer::get();
        return view('admin.appointments.user-appointment',compact(
            'title','patients','tests'
        ));
    }

    public function updateStatus(Request $request){
        if($request->ajax()){
            $appointment = Appointment::findOrFail($request->appointment)->update([
                'status' => ($request->status == '1') ? 0: 1,
                'approved_by' => auth()->user()->id
            ]);
            if($appointment){
                return response()->json(['type' => 1,'message' => "Appointment status updated successfully"]);
            }else{
                return response()->json(['type' => 0,'message' => "Something went wrong"]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);
        Appointment::create([
            'code' => 'APT-'.random_str(12),
            'user_id' => $request->patient,
            'test_offers' => $request->tests,
            'gender' => $request->gender,
            'address' => $request->address,
            'appointment_date' => $request->date,
        ]);
        $notification = notify("appointment has been created");
        return back()->with($notification);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'patient' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);
        Appointment::findOrFail($request->id)->update([
            'user_id' => $request->patient,
            'test_offers' => $request->tests,
            'gender' => $request->gender,
            'address' => $request->address,
            'appointment_date' => $request->date,
        ]);
        $notification = notify("appointment has been updated");
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return Appointment::findOrFail($request->id)->delete();
    }
}
