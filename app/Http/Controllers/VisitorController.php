<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Visitor;

class VisitorController extends Controller
{

    /**
     * Show the list of visitors
     */
    public function adminIndex(Request $request)
    {
        $query = DB::table('visitors')
            ->leftJoin('locations', 'visitors.location_id', '=', 'locations.id')
            ->select('visitors.*', 'locations.name as location_name')
            ->orderBy('visitors.created_at', 'desc');

        if ($request->filled('location')) {
            $query->where('visitors.location_id', $request->location);
        }

        if ($request->filled('date')) {
            $date = $request->date;
            $query->whereDate('visitors.visit_datetime', $date);
        }

        $visitors = $query->paginate(15)->withQueryString();

        if ($request->ajax() || $request->filled('ajax')) {
            return view('admin.partials.visitor-table', compact('visitors'))->render();
        }

        $locations = DB::table('locations')->where('active', true)->get();

        return view('admin.visitorList', compact('visitors', 'locations'));
    }

    /**
     * Show the form for creating a new visitor
     */
    public function create()
    {
        $locationId = session('selected_location_id');
        $locationName = session('selected_location_name');

        if (!$locationId) {
            return redirect()->route('locations')
                ->with('error', 'Please select a location first.');
        }

        return view('visitors.newVisitor', compact('locationId', 'locationName'));
    }

    /**
     * Store a newly created visitor
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'purpose' => 'nullable|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $visitorId = DB::table('visitors')->insertGetId([
            'location_id' => $request->location_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'purpose' => $request->purpose,
            'visit_datetime' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('visitors')
            ->with('success', 'Visitor registered successfully!');
    }

    public function saveReturningVisitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visitor_id' => 'required|integer|exists:visitors,id',
            'purpose' => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $visitor = DB::table('visitors')->where('id', $request->visitor_id)->first();

        if (!$visitor) {
            return redirect()->route('returningVisitor')
                ->with('error', 'Visitor not found.');
        }

        $visitorId = DB::table('visitors')->insertGetId([
            'location_id' => $request->location_id,
            'name' => $visitor->name,
            'email' => $visitor->email,
            'phone' => $visitor->phone,
            'purpose' => $request->purpose,
            'visit_datetime' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('visitors')
            ->with('success', 'Returning visitor checked in successfully!');
    }

    /**
     * Show form for returning visitors
     */
    public function showReturningForm(Request $request)
    {
        $locationId = session('selected_location_id');
        $locationName = session('selected_location_name');

        if (!$locationId) {
            return redirect()->route('locations')
                ->with('error', 'Please select a location first.');
        }

        $email = $request->input('email');
        $visitor = null;
        $activeVisitor = null;
        $status = null;

        if ($email) {
            $visitor = DB::table('visitors')
                ->where('email', $email)
                ->where('left', true)
                ->orderBy('left_datetime', 'desc')
                ->first();

            if ($visitor) {
                $status = 'has_history';
            } else {
                $activeVisitor = DB::table('visitors')
                    ->where('email', $email)
                    ->where('left', false)
                    ->first();

                if ($activeVisitor) {
                    $status = 'not_checked_out';
                } else {
                    $status = 'not_found';
                }
            }
        }

        Log::info('Returning visitor data:', [
            'visitor' => $visitor,
            'activeVisitor' => $activeVisitor,
            'status' => $status,
            'email' => $email
        ]);

        return view('visitors.returningVisitor', compact('visitor', 'activeVisitor', 'status', 'email', 'locationId', 'locationName'));
    }

    /**
     * Show form for visitors leaving
     */
    public function showLeavingForm(Request $request)
    {
        $locationId = session('selected_location_id');
        $locationName = session('selected_location_name');

        if (!$locationId) {
            return redirect()->route('locations')
                ->with('error', 'Please select a location first.');
        }

        $email = $request->input('email');
        $visitor = null;
        $leftVisitor = null;
        $status = null;

        if ($email) {
            $visitor = DB::table('visitors')
                ->where('email', $email)
                ->where('location_id', $locationId)
                ->where('left', false)
                ->first();

            if ($visitor) {
                $status = 'active';
            } else {
                $leftVisitor = DB::table('visitors')
                    ->where('email', $email)
                    ->where('location_id', $locationId)
                    ->where('left', true)
                    ->orderBy('left_datetime', 'desc')
                    ->first();

                if ($leftVisitor) {
                    $status = 'already_left';
                } else {
                    $status = 'not_found';
                }
            }
        }

        return view('visitors.leavingVisitor', compact('visitor', 'leftVisitor', 'status', 'locationId', 'locationName'));
    }

    public function adminLeavingVisitor(Request $request)
    {
        $visitorId = $request->input('visitor_id');
        $visitor = Visitor::find($visitorId);

        if (!$visitor) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visitor not found'
                ], 404);
            }
            return redirect()->route('admin.visitors')->with('error', 'Visitor not found');
        }

        if ($visitor->left) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Visitor has already checked out'
                ], 400);
            }
            return redirect()->route('admin.visitors')->with('error', 'Visitor has already checked out');
        }

        $visitor->left = true;
        $visitor->left_datetime = now();
        $visitor->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Visitor checked out successfully'
            ]);
        }

        return redirect()->route('admin.visitors')->with('success', 'Visitor checked out successfully!');
    }

    public function saveLeavingVisitor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visitor_id' => 'required|integer|exists:visitors,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('leavingVisitor');
        } {
            $visitorId = $request->input('visitor_id');

            DB::table('visitors')->where('id', $visitorId)->update(['left' => true, 'left_datetime' => now()]);

            return redirect()->route('visitors')->with('success', 'Visitor checked out successfully!');
        }
    }

    public function leavingVisitor(Request $request)
    {
        if (!$request->ajax()) {
            return redirect()->back()->with('error', 'Invalid request');
        }

        $visitor = Visitor::find($request->visitor_id);

        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found'
            ], 404);
        }

        if ($visitor->left) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor has already checked out'
            ], 400);
        }

        $visitor->left = true;
        $visitor->left_datetime = now();
        $visitor->save();

        return response()->json([
            'success' => true,
            'message' => 'Visitor checked out successfully'
        ]);
    }
}
