<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Career;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    //
    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $response['response'] = $validator->messages();
        } else {

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Unauthorized'
                ], 401);
            }
            $user = $request->user();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => "successfully logged",
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }
    }

    public function createCareer(Request $request)
    {
        $rules = [
            'designation' => 'required',
            'experience' => 'required',
            'job_description' => 'required',
            'expiry_date' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $response['response'] = $validator->messages();
        } else {
            $career = Career::create($request->all());
            if ($career) {
                return response()->json([
                    'status' => "success"
                ]);
            } else {
                return response()->json([
                    'status' => "success"
                ]);
            }
        }
    }

    public function createApplication(Request $request)
    {
        $rules = [
            'designation' => 'required',
            'experience' => 'required',
            'name' => 'required',
            'resume' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $response['response'] = $validator->messages();
        } else {
            $formFields = new Application;
            $formFields->designation = $request->designation;
            $formFields->name = $request->name;
            $formFields->experience = $request->experience;
            if ($request->hasFile('resume')) {
                $filenameWithExt = $request->file('resume')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('resume')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('resume')->storeAs('public/resume', $fileNameToStore);
                $formFields->resume = $fileNameToStore;
            }
            $formFields->save();
            if ($formFields) {
                return response()->json([
                    'status' => "success"
                ]);
            } else {
                return response()->json([
                    'status' => "success"
                ]);
            }
        }
    }

    public function listCareers()
    {
        $result = Career::all();
        if ($result) {
            return response()->json([
                'status' => "success",
                'result' => $result
            ]);
        } else {
            return response()->json([
                'status' => "failed",
                'result' => 'No data found'
            ]);
        }
    }

    public function listApplications()
    {
        $result = Application::all();
        if ($result) {
            return response()->json([
                'status' => "success",
                'result' => $result
            ]);
        } else {
            return response()->json([
                'status' => "failed",
                'result' => 'No data found'
            ]);
        }
    }
}
