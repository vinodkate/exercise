<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\MacAddress;
use App\Router;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $routers = Router::paginate(10);
       return view('router.index', compact('routers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $router = Router::find($id);
        if(! $router) {
            return response()->json(['status'=> false, 'message' => 'Router not found']);
        }
        return response()->json(['status'=> true, 'message' => 'Router Found', 'data' => $router]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [   
            'sap_id' => 'required|max:18|unique:routers,sap_id,'.$id,
            'type' => 'required|in:AG1,CSS',
            'host_name' => 'required|max:14|unique:routers,host_name,'.$id,  
            'loopback' => 'required|ipv4|unique:routers,loopback,'.$id,      
            'mac_address' => ['required','max:17','unique:routers,mac_address,'.$id, new MacAddress],         
        ]);

        // If validation fails send error
        if($validator->fails()) {
            return response()->json(['status'=> false, 'message' => $validator->messages()->first()]);
        }

        $router = Router::find($id);
        $router->fill($request->all())->save();
        return response()->json(['status'=> true, 'message' => 'Router updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $router = Router::find($id);
        if(! $router) {
            return response()->json(['status'=> false, 'message' => 'Router not found']);
        }
        $router->delete();
        return response()->json(['status'=> true, 'message' => 'Router deleted successfully']);
    }
    
}
