<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\LGA;
use App\Model\Ward;
use App\Model\Street;
use App\User;
use Auth;
use DB;
use App\Model\Businesses;
use App\Model\Buildings;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function business_search_report(){
        $lga = LGA::all();
        $wards = Ward::all();
        $streets = Street::all();
        $users = User::where(['service_id'=> Auth::user()->service_id])->get();
        return view('bussiness_search_report',compact('lga','wards','streets','users'));
    }


    /**
     * Search Business.
     *
     * @param  Request  $request
     * @return Response
     */
    public function business_result_report(Request $request){
        
        $business_name = $request->input('business_name') ? $request->input('business_name') : '%%';
        $building_number = $request->input('building_number') ? $request->input('building_number') : '%%';
        $business_lga = $request->input('lga');
        $ward = $request->input('ward');
        $street = $request->input('street');
        $registered_by = $request->input('users');
        $registered_on = $request->input('registered_on') ? $request->input('registered_to') : '1000-01-01';
        $registered_to = $request->input('registered_to') ? $request->input('registered_to') : date('Y-m-d');


        $search_result = DB::table('businesses')
            ->select(
            'businesses.business_name',
            'businesses.business_lga',
            'businesses.business_category',
            'businesses.created_by',
            'businesses.created_at',
            'businesses.apartment_id',
            'businesses.building_id',
            'wards.ward',
            'buildings.building_id',
            'buildings.building_rin',
            'buildings.building',
            'buildings.building_tag_number',
            'buildings.building_name',
            'buildings.building_number',
            'buildings.building_address',
            'buildings.street',
            'buildings.off_street',
            'buildings.town',
            'buildings.lga',
            'buildings.ward',
            'buildings.asset_type',
            'buildings.building_type',
            'buildings.building_completion',
            'buildings.building_purpose',
            'buildings.building_function',
            'buildings.building_ownership',
            'buildings.building_occupancy',
            'buildings.Building_occupancy_type',
            'buildings.created_by',
            'buildings.created_at',
            'buildings.land_id',
            '_apartments.id_apartment',
            '_apartments.aparment',
            '_apartments.apartment_type_id',
            '_apartments.building_id',
            '_apartments.service_id',
            '_apartments.registered_by',
            '_apartments.registered_on',
            '_apartments.active',
            '_apartments.apartment_id',
            'lands.land_id',
            'lands.land_rin',
            'lands.land',
            'lands.land_tag_number',
            'lands.land_name',
            'lands.land_number',
            'lands.land_address',
            'lands.street',
            'lands.off_street',
            'lands.town',
            'lands.lga',
            'lands.ward',
            'lands.asset_type',
            'lands.land_type',
            'lands.land_purpose',
            'lands.land_function',
            'lands.land_ownership',
            'lands.Latitude',
            'lands.Longitude',
            'lands.created_by',
            'lands.created_at',
            'wards.lga')
            ->leftJoin('buildings', 'businesses.building_id', '=', 'buildings.building_id')
            ->leftJoin('_apartments', 'businesses.apartment_id', '=', '_apartments.apartment_id')
            ->leftJoin('lands', 'buildings.land_id', '=', 'lands.land_id')
            ->leftJoin('wards', 'businesses.business_lga', '=', 'wards.lga')
            ->where('businesses.business_name', 'like', $business_name)
            ->Where('buildings.building_number', 'like', $building_number)
            ->Where('businesses.business_lga', 'like', $business_lga)
            ->Where('wards.ward', 'like', $ward)
            ->Where('buildings.street', 'like', $street)
            ->Where('businesses.created_by', 'like', $registered_by)
            ->whereDate('businesses.created_at', '>=', $registered_on)
            ->whereDate('businesses.created_at', '<=', $registered_to)
            ->get();

        $count_search_result = count($search_result);
        if( $count_search_result == 0){
            return back()->with('info', 'No search record found. Kindly try again !');
        }

        $search_result = $search_result->groupBy('business_category');
        $search_result = $search_result->toArray();
        $data_points = array();
        
        foreach ($search_result as $key => $result) {
            $points = array("y" => count($result), "label" => $key);
            array_push($data_points, $points);
        }

        return view('bussiness_result_report',compact('data_points'));
        
    }

    /**
     * Show the business search map.
     *
     * @return \Illuminate\Http\Response
     */
    public function business_search_map(){

        $lga = LGA::all();
        $wards = Ward::all();
        $streets = Street::all();
        $users = User::where(['service_id'=> Auth::user()->service_id])->get();

        return view('bussiness_search_map', compact('lga','wards','users','streets'));

    }
    
    /**
     * Business Result Map.
     *
     * @param  Request  $request
     * @return Response
     */
    public function business_result_map(Request $request){

        $business_name = $request->input('business_name') ? $request->input('business_name') : '%%';
        $building_number = $request->input('building_number') ? $request->input('building_number') : '%%';
        $latitude = $request->input('latitude') ? $request->input('latitude') : '%%';
        $longitude = $request->input('longitude') ? $request->input('longitude') : '%%';
        $business_lga = $request->input('lga');
        $ward = $request->input('ward');
        $street = $request->input('street');
        $registered_by = $request->input('users');
        $registered_on = $request->input('registered_on') ? $request->input('registered_to') : '1000-01-01';
        $registered_to = $request->input('registered_to') ? $request->input('registered_to') : date('Y-m-d');

        
        $search_result = DB::table('businesses')
            ->select('businesses.business_name','buildings.Latitude', 'buildings.Longitude')
            ->leftJoin('buildings', 'businesses.building_id', '=', 'buildings.building_id')
            ->leftJoin('_apartments', 'businesses.apartment_id', '=', '_apartments.apartment_id')
            ->leftJoin('lands', 'buildings.land_id', '=', 'lands.land_id')
            ->leftJoin('wards', 'businesses.business_lga', '=', 'wards.lga')
            ->where('businesses.business_name', 'like', $business_name)
            ->Where('buildings.building_number', 'like', $building_number)
            ->Where('buildings.Latitude', 'like', $latitude)
            ->Where('buildings.Longitude', 'like', $longitude)
            ->Where('businesses.business_lga', 'like', $business_lga)
            ->Where('wards.ward', 'like', $ward)
            ->Where('buildings.street', 'like', $street)
            ->Where('businesses.created_by', 'like', $registered_by)
            ->whereDate('businesses.created_at', '>=', $registered_on)
            ->whereDate('businesses.created_at', '<=', $registered_to)
            ->get();
        //dd($search_result);

        $search_result = $search_result->toArray();
        //dd($search_result);
        $data_points = array();

        foreach ($search_result as $key => $result) {
            $points = array("lat" => $result->Latitude, "lng" => $result->Longitude, "info" => $result->business_name);
            array_push($data_points, $points);
        }

        //dd($data_points);

        return view('bussiness_result_map', compact('data_points'));

    }
}
