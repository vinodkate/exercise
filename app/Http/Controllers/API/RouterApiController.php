<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Rules\MacAddress;
use Illuminate\Support\Facades\DB;
use App\Router;
use App\Traits\ResponseFormat;
class RouterApiController extends Controller
{
    use ResponseFormat;
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ip_start' => 'required|ipv4',      
            'ip_end' => 'required|ipv4',          
        ]);

        // If validation fails send error
        if($validator->fails()) {
            return response()->json(['status'=> false, 'message' => $validator->messages()->first()]);
        }
        
        // convert ip to long int
        $ip_start = ip2long($request->ip_start);
        $ip_end   = ip2long($request->ip_end);

        $paginator = DB::table('routers')
                ->whereBetween(DB::raw('INET_ATON(loopback)'), [$ip_start, $ip_end])
                ->paginate(10);
        $routers = $this->paginateData($paginator);

        return response()->json(['status'=> true, 'message' => 'Success', 'data' => $routers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sap_id' => 'required|max:18|unique:routers',
            'type' => 'required|in:AG1,CSS',      
            'host_name' => 'required|max:14|unique:routers',  
            'loopback' => 'required|ipv4|unique:routers',      
            'mac_address' => ['required','max:17','unique:routers', new MacAddress],           
        ]);

        // If validation fails send error
        if($validator->fails()) {
            return response()->json(['status'=> false, 'message' => $validator->messages()->first()]);
        }

        $router = Router::create($request->all());
    
        return response()->json(['status' => true, 'message' => 'Router created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sapid)
    {
        $router_sapid = Router::where('sap_id', $sapid)->first();
        if(! $router_sapid) {
            return response()->json(['status' => false, 'message' => 'Router does not exist with this sap id.']);
        }

        return response()->json(['status'=> true, 'message' => 'Router Found', 'data' => $router_sapid]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $loopback)
    {
        $router_ip = Router::where('loopback', $loopback)->first();
        if(! $router_ip) {
            return response()->json(['status' => false, 'message' => 'Router does not exist with this ip']);
        }

        $validator = Validator::make($request->all(), [
            'sap_id' => 'required|max:18|unique:routers', 
            'type' => 'required|in:AG1,CSS',      
            'host_name' => 'required|max:14|unique:routers',      
            'mac_address' => ['required','max:17','unique:routers', new MacAddress],             
        ]);

        // If validation fails send error
        if($validator->fails()) {
            return response()->json(['status'=> false, 'message' => $validator->messages()->first()]);
        }

        $router_ip->fill($request->all())->save();
        return response()->json(['status'=> true, 'message' => 'Router updated successfully']);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($loopback)
    {
        $router = Router::where('loopback', $loopback)->first();
        if(! $router) {
            return response()->json(['status'=> false, 'message' => 'Router does not exist with this ip']);
        }
        $router->delete();
        return response()->json(['status'=> true, 'message' => 'Router deleted successfully']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:AG1,CSS',         
        ]);

        // If validation fails send error
        if($validator->fails()) {
            return response()->json(['status'=> false, 'message' => $validator->messages()->first()]);
        }

        $paginator = Router::where('type', $request->type)->paginate(10);
        $routers = $this->paginateData($paginator);

        return response()->json(['status'=> true, 'message' => 'Success', 'data' => $routers]);
    }
    

}
