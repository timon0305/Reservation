<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Model\Floor;
use App\Model\Reservation;
use App\Model\ReservationNight;
use App\Model\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $data['floor_plan'] = Floor::get();
        $data['room_type'] = RoomType::get();
        $data['date']=\request()->date?Carbon::parse(\request()->date)->format('Y-m-d'):Carbon::now()->format('Y-m-d');
        $data['current_reservation'] = Reservation::whereHas('night',function ($q){
            $q->where('date',Carbon::now()->format('Y-m-d'));
        })->whereNotIn('status',['CANCEL'])->get();

        $data['upcoming_reservation'] = Reservation::whereNotIn('status',['CANCEL'])->where('check_in','>',Carbon::now()->format('Y-m-d'))->get();
        $total_chart = $this->chartData();
        return view('backend.admin.index',compact('data','total_chart'));
    }
    public function chartData(){
        $subscribe = Reservation::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
            return $d->created_at->format('F');
        });
        $monthly_chart =collect([]);
        foreach (month_arr() as $key => $value) {
            $monthly_chart->push([
                'month' => Carbon::parse(date('Y').'-'.$key)->format('Y-m'),
                'online' =>$subscribe->has($value)?$subscribe[$value]->where('online',1)->count():0,
                'offline' =>$subscribe->has($value)?$subscribe[$value]->where('online',0)->count():0,
            ]);

        }
        return response()->json($monthly_chart->toArray())->content();
    }
}
