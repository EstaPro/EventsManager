<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Conference;
use App\Models\Event;
use App\Models\ContactRequest;
use App\Http\Resources\AppointmentResource;
use OpenApi\Attributes as OA;

class UserActionController extends Controller
{
    #[OA\Get(path: '/api/my-agenda', tags: ['User Actions'], summary: 'Get My Schedule', security: [['bearerAuth' => []]])]
    #[OA\Response(response: 200, description: 'List of booked items')]
    public function myAgenda(Request $request)
    {
        $appointments = Appointment::where('visitor_id', $request->user()->id)
            ->with(['company', 'conference'])
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return AppointmentResource::collection($appointments);
    }

    #[OA\Post(path: '/api/attend-conference', tags: ['User Actions'], summary: 'Join a Conference', security: [['bearerAuth' => []]])]
    #[OA\RequestBody(content: new OA\JsonContent(properties: [new OA\Property(property: 'conference_id', type: 'integer')]))]
    #[OA\Response(response: 200, description: 'Successfully added to agenda')]
    #[OA\Response(response: 404, description: 'Conference not found')] // ✅ Added this documentation
    #[OA\Response(response: 409, description: 'Already registered')]
    public function attendConference(Request $request)
    {
        // 1. Basic format validation only
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'conference_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data', 'errors' => $validator->errors()], 422);
        }

        // 2. Explicitly find or return 404 JSON
        $conf = Conference::find($request->conference_id);

        if (!$conf) {
            // 🛑 Stops here and returns JSON error instead of redirecting
            return response()->json(['message' => 'Conference not found'], 404);
        }

        $user = $request->user();

        // 3. Prevent Duplicate
        $exists = Appointment::where('visitor_id', $user->id)
            ->where('conference_id', $conf->id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already registered'], 409);
        }

        // 4. Create Appointment
        Appointment::create([
            'event_id' => $conf->event_id,
            'visitor_id' => $user->id,
            'conference_id' => $conf->id,
            'type' => 'conference',
            'scheduled_at' => $conf->start_time,
            'status' => 'confirmed'
        ]);

        return response()->json(['message' => 'Added to your agenda']);
    }

    #[OA\Post(path: '/api/book-meeting', tags: ['User Actions'], summary: 'Request B2B Meeting', security: [['bearerAuth' => []]])]
    #[OA\RequestBody(content: new OA\JsonContent(properties: [
        new OA\Property(property: 'company_id', type: 'integer'),
        new OA\Property(property: 'scheduled_at', type: 'string', format: 'date-time'),
        new OA\Property(property: 'notes', type: 'string')
    ]))]
    #[OA\Response(response: 200, description: 'Meeting request sent')]
    public function bookMeeting(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'scheduled_at' => 'required|date|after:now',
        ]);

        $event = Event::where('is_active', true)->firstOrFail();

        Appointment::create([
            'event_id' => $event->id,
            'visitor_id' => $request->user()->id,
            'company_id' => $request->company_id,
            'type' => 'b2b',
            'scheduled_at' => $request->scheduled_at,
            'status' => 'pending',
            'notes' => $request->notes ?? ''
        ]);

        return response()->json(['message' => 'Meeting request sent']);
    }

    #[OA\Delete(path: '/api/appointments/{id}', tags: ['User Actions'], summary: 'Cancel Appointment', security: [['bearerAuth' => []]])]
    #[OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))]
    #[OA\Response(response: 200, description: 'Appointment cancelled')]
    public function cancel(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)
            ->where('visitor_id', $request->user()->id)
            ->firstOrFail();

        $appointment->delete();

        return response()->json(['message' => 'Appointment cancelled']);
    }

    #[OA\Post(path: '/api/contact', tags: ['User Actions'], summary: 'Contact Support', security: [['bearerAuth' => []]])]
    #[OA\RequestBody(content: new OA\JsonContent(properties: [
        new OA\Property(property: 'subject', type: 'string'),
        new OA\Property(property: 'message', type: 'string')
    ]))]
    #[OA\Response(response: 200, description: 'Message sent')]
    public function contactSupport(Request $request)
    {
        $request->validate(['subject' => 'required', 'message' => 'required']);

        ContactRequest::create([
            'name' => $request->user()->name,
            'email' => $request->user()->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'is_handled' => false
        ]);

        return response()->json(['message' => 'Message sent']);
    }
}
