<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RateReplyResource;
use App\Models\Rate;
use App\Models\RateReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $feedback = RateReply::all();
            } else {
                $feedback = $user->RateReplies()->get();
            }
            return response()->json(['success' => true, 'data' => RateReplyResource::collection($feedback)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'rate_id' => 'required|integer',
            'hospital_id' => 'integer|exists:hospitals,id',
            'content' => 'required|string',
        ]);
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response()->json(['success' => true, 'message'=>'Go to back end'],200);
            }elseif($user->hasRole('hospital')){
                $rate=Rate::where('id',$data['rate_id'])->first();
                if($rate->id=$data['rate_id']){
                    $data['rate_id']=$rate->id;
                    $data['hospital_id']=$rate->hospital_id;
                    RateReply::create($data);
                    return response()->json(['success' => true,'message'=>'Reply added successfully'],201);
                }
            }else{
                return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
            }
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RateReply $rateReply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RateReply $rateReply)
    {
        $data = $request->validate([
            'content' => 'required|string',
            'hospital_id' => 'required',
            'star' => 'integer'
        ]);
        $user = Auth::user();
        try {
            if (!$user->hasRole('admin')) {
                if($user->hasRole('hospital')){
                    if ($rateReply->hospital_id == $user->hospital_id) {
                        $data['hospital_id'] = $user->hospital->id;
                        $rateReply->update($data);
                        return response()->json(['success' => true, 'message' => 'Rate has been updated'], 201);
                    }else{
                        return response()->json(['success' => false, 'message' => 'You are not allowed to access this page'],403);
                    }
                }else{
                    return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
                }
            }else{
                return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RateReply $rateReply)
    {
        $user = Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    if($user->hospital->id==$rateReply->hospital_id) {
                        $rateReply->delete();
                        return response()->json(['success' => true, 'message' => 'Rate has been deleted'], 201);
                    }else{
                        return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
                    }
                }else{
                    return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
                }
            }else{
                return response()->json(['success' => false, 'message'=>'You are not allowed to access this page'],403);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        };
    }
}
