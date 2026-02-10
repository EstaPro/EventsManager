<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class NotificationController extends Controller
{
    #[OA\Post(path: '/api/fcm-token', tags: ['User Actions'], summary: 'Save Mobile Device Token', security: [['bearerAuth' => []]])]
    #[OA\RequestBody(content: new OA\JsonContent(properties: [new OA\Property(property: 'token', type: 'string')]))]
    #[OA\Response(response: 200, description: 'Token saved')]
    public function updateDeviceToken(Request $request)
    {
        $request->validate(['token' => 'required|string']);

        $request->user()->update([
            'fcm_token' => $request->token
        ]);

        return response()->json(['message' => 'Device registered for notifications']);
    }

    #[OA\Get(path: '/api/notifications', tags: ['User Actions'], summary: 'Get User Notifications', security: [['bearerAuth' => []]])]
    public function index(Request $request)
    {
        // Returns the last 20 notifications sent to this user
        return response()->json([
            'data' => $request->user()->notifications()->limit(20)->get()
        ]);
    }
}
