<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    /**
     * Display the list of locations.
     */
    public function index()
    {
        $locations = Location::where('active', true)->get();
        return view('locations.index', compact('locations'));
    }

    /**
     * Create a seeder method to populate locations for testing
     */
    public function seedLocations()
    {
        if (app()->environment('local')) {
            Location::truncate();

            Location::create([
                'name' => 'Main Office',
                'description' => 'Headquarters and main reception area',
                'active' => true,
            ]);

            Location::create([
                'name' => 'Building A',
                'description' => 'Research and Development',
                'active' => true,
            ]);

            Location::create([
                'name' => 'Building B',
                'description' => 'Sales and Marketing',
                'active' => true,
            ]);

            Location::create([
                'name' => 'Conference Center',
                'description' => 'Meeting and event space',
                'active' => true,
            ]);

            return redirect()->route('locations')->with('success', 'Sample locations created successfully!');
        }

        return redirect()->route('locations')->with('error', 'This action is only available in the local environment.');
    }

    /**
     * Select a location and proceed to the visitors page
     */
    public function selectLocation($id)
    {
        $location = Location::findOrFail($id);

        session(['selected_location_id' => $location->id, 'selected_location_name' => $location->name]);

        return redirect()->route('visitors');
    }

    /**
     * Display the list of locations in the admin area.
     */
    public function adminIndex()
    {
        $locations = Location::orderBy('name')->get();
        return view('admin.locations', compact('locations'));
    }

    /**
     * Store a newly created location.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'active' => 'sometimes|boolean',
        ]);

        $validated['active'] = $request->has('active');

        Location::create($validated);

        return redirect()->route('admin.locations')
            ->with('success', 'Location created successfully!');
    }

    /**
     * Toggle a location's active status.
     */
    public function toggleStatus(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        $location->active = !$location->active;
        $location->save();

        $status = $location->active ? 'activated' : 'deactivated';
        return redirect()->route('admin.locations')
            ->with('success', "Location {$status} successfully!");
    }

    /**
     * Remove the specified location.
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        $hasVisitors = DB::table('visitors')
            ->where('location_id', $id)
            ->exists();

        if ($hasVisitors) {
            return redirect()->route('admin.locations')
                ->with('error', 'Cannot delete location because it has visitors associated with it. Deactivate it instead.');
        }

        $location->delete();

        return redirect()->route('admin.locations')
            ->with('success', 'Location deleted successfully!');
    }
}
