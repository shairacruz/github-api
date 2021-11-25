<?php

namespace App\Http\Controllers;

use App\Library\ConstantLibrary;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register (Request $oRequest) {
        $aData = $oRequest->validate([
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|confirmed'
        ]);

        $aUser = User::create([
            'username' => $aData['username'],
            'password' => bcrypt($aData['password'])
        ]);

        $sToken = $aUser->createToken('githubtoken')->plainTextToken;
        $oResponse = [
            'status_code' => ConstantLibrary::STATUS_CODE_200,
            'user'        => $aUser,
            'token'       => $sToken
        ];

        return response($oResponse, ConstantLibrary::STATUS_CODE_200);
    }

    public function logout(Request $oRequest) {
        auth()->user()->tokens()->delete();
        return [
            'status_code' => ConstantLibrary::STATUS_CODE_200,
            'message'     => 'Logged out'
        ];
    }

    public function login (Request $oRequest) {
        $aData = $oRequest->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $aUser = User::where('username', $aData['username'])->first();

        if (!$aUser || !Hash::check($aData['password'], $aUser->password)) {
            $oResponse = [
                'message'     => ConstantLibrary::STATUS_CODE_300_MESSAGE
            ];
            return response($oResponse, ConstantLibrary::STATUS_CODE_300);
        }

        $sToken = $aUser->createToken('githubtoken')->plainTextToken;
        $oResponse = [
            'status_code' => ConstantLibrary::STATUS_CODE_200,
            'user'        => $aUser,
            'token'       => $sToken
        ];

        return response($oResponse, ConstantLibrary::STATUS_CODE_200);
    }
}
