<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestResultsController extends Controller
{

    public function index(Request $request){
        if($request->ajax()){
            $results = TestResult::get();
            return DataTables::of($results)
                ->addColumn('added_by', function($row){
                    return $row->addedBy->name ?? '';
                })
                ->addColumn('patient', function($row){
                    return $row->appointment->user->name ?? '';
                })
                ->addColumn('appointment', function($row){
                    return $row->appointment->code ?? '';
                })
                ->addColumn('date_created', function($row){
                    return date_format(date_create($row->created_at),'d M, Y');
                })
                ->addColumn('send_sms', function($row){
                    $btn = '<button type="button" data-phone="'.$row->appointment->user->phone.'" class="send_sms_btn btn btn-info">Send SMS</button>';
                    return $btn;
                })
                ->addColumn('action',function ($row){
                    $editbtn = '<a data-id="'.($row->id).'" data-appointment="'.($row->appointment_id).'" data-summary="'.($row->summary).'" data-details="'.($row->details).'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                    $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('test-results.destroy').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                    if(!auth()->user()->hasPermissionTo('edit-TestResult')){
                        $editbtn = '';
                    }
                    if(!auth()->user()->hasPermissionTo('destroy-TestResult')){
                        $deletebtn = '';
                    }
                    $btn = $editbtn.' '.$deletebtn;
                    return $btn;
                })
                ->rawColumns(['action','send_sms'])
                ->make(true);
        }
        $title = 'test results';
        $appointments = Appointment::get();
        return view('admin.results.index',compact(
            'title','appointments'
        ));
    }
    public function userTestResults(Request $request){

        if($request->ajax()){
            $results = TestResult::whereHas('appointment', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
            return DataTables::of($results)
                ->addColumn('added_by', function($row){
                    return $row->addedBy->name ?? '';
                })
                ->addColumn('patient', function($row){
                    return $row->appointment->user->name ?? '';
                })
                ->addColumn('appointment', function($row){
                    return $row->appointment->code ?? '';
                })
                ->addColumn('date_created', function($row){
                    return date_format(date_create($row->created_at),'d M, Y');
                })
                ->addColumn('send_sms', function($row){
                    $btn = '<button type="button" data-phone="'.$row->appointment->user->phone.'" class="send_sms_btn btn btn-info">Send SMS</button>';
                    return $btn;
                })
                ->addColumn('action',function ($row){
                    $viewbtn = '<a data-id="'.($row->id).'" data-appointment="'.($row->appointment_id).'" data-summary="'.($row->summary).'" data-details="'.($row->details).'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-eye"></i></button></a>';
                    return $viewbtn;
                })
                ->rawColumns(['action','send_sms'])
                ->make(true);
        }
        $title = 'my test results';
        return view('admin.results.user-test-results',compact(
            'title',
        ));
    }

    public function sendNotification(Request $request){
        if($request->ajax()){
            $sender = 'LabTech';
            $sms = sendSMS($sender,$request->phone, $request->message);
            if($sms){
                return response()->json(['type' => 1,'message' => "SMS has been sent successfully"]);
            }else{
                return response()->json(['type' => 0,'message' => "Something went wrong"]);
            }
        }
    }

    public function store(Request $request){
        $request->validate([
            'appointment' => 'required',
            'summary' => 'required',
            'details' => 'required',
        ]);
        TestResult::create([
            'appointment_id' => $request->appointment,
            'summary' => $request->summary,
            'details' => $request->details,
            'added_by' => auth()->user()->id,
            'file' => $request->file,
        ]);
        $notification = notify("Test results has been added");
        return back()->with($notification);
    }

    public function update(Request $request){
        $request->validate([
            'appointment' => 'required',
            'summary' => 'required',
            'details' => 'required',
        ]);
        TestResult::findOrFail($request->id)->update([
            'appointment_id' => $request->appointment,
            'summary' => $request->summary,
            'details' => $request->details,
            'added_by' => auth()->user()->id,
            'file' => $request->file,
        ]);
        $notification = notify("Test results has been updated");
        return back()->with($notification);
    }
    public function destroy(Request $request){
        return TestResult::findOrFail($request->id)->delete();
    }
}
