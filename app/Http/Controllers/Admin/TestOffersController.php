<?php

namespace App\Http\Controllers\Admin;

use App\Models\TestOffer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use QCod\AppSettings\Setting\AppSettings;

class TestOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'test offers';
        if ($request->ajax()){
            $test_offers = TestOffer::get();
            return DataTables::of($test_offers)
                    ->addIndexColumn()
                    ->addColumn('test_price',function($row){
                        $currency = setting()->get('app_currency');
                        return $currency.' '.$row->price;
                    })
                    ->addColumn('action',function ($row){
                        $editbtn = '<a data-id="'.$row->id.'" data-name="'.$row->name.'" data-price="'.$row->price.'" data-description="'.$row->description.'" href="javascript:void(0)" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$row->id.'" data-route="'.route('test-offer.destroy').'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-TestOffer')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-TestOffer')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.test-offers',compact(
            'title'
        ));
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);
        TestOffer::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        $notification = notify('Test offer has been created');
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
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);
        TestOffer::findOrFail($request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        $notification = notify('Test offer has been updated');
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
        return TestOffer::findOrFail($request->id)->delete();
    }
}
