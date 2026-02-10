<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserResource;
use Orchid\Platform\Models\Role;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * REGISTER NEW VISITOR
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // Requires 'password_confirmation' field
            'job_title' => 'nullable|string|max:100',
            'company_name' => 'nullable|string|max:100', // Optional: Store company name
        ]);

        // 1. Generate Unique Badge Code
        $badgeCode = 'VIS-' . strtoupper(Str::random(6));
        while (User::where('badge_code', $badgeCode)->exists()) {
            $badgeCode = 'VIS-' . strtoupper(Str::random(6));
        }

        // 2. Create User
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'job_title' => $request->job_title,
            'badge_code' => $badgeCode,
            'is_visible' => true,
            // 'company_id' => null // Visitors usually don't have a linked Company ID initially
        ]);

        // 3. Assign 'Visitor' Role (Orchid)
        $visitorRole = Role::where('slug', 'visitor')->first();
        if ($visitorRole) {
            $user->addRole($visitorRole);
        }

        // 4. Auto-Login (Generate Token)
        $token = $user->createToken('mobile_app')->plainTextToken;

        return response()->json([
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ], 201);
    }

    /**
     * LOGIN
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        return response()->json([
            'access_token' => $user->createToken('mobile_app')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }


    /**
     * GET PROFILE
     */
    #[OA\Get(path: '/api/me', tags: ['Auth'], summary: 'Get User Profile', security: [['bearerAuth' => []]])]
    #[OA\Response(response: 200, description: 'User Data')]
    public function me(Request $request)
    {
        return new UserResource($request->user());
    }

    /**
     * LOGOUT
     */
    #[OA\Post(path: '/api/logout', tags: ['Auth'], summary: 'Revoke Token', security: [['bearerAuth' => []]])]
    #[OA\Response(response: 200, description: 'Logged out')]
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
