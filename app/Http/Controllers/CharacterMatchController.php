<?php

namespace App\Http\Controllers;

use App\Models\CharacterMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterMatchController extends Controller
{
    // Display character list
    public function index()
    {
        $recentMatches = CharacterMatch::where('user_id', Auth::id())
                                       ->orderBy('created_at', 'desc')
                                       ->take(5)
                                       ->get();

        return view('character-match.index', compact('recentMatches'));
    }

    // Proses matching
    public function process(Request $request)
    {
        $request->validate([
            'first_input' => 'required|string|max:255',
            'second_input' => 'required|string|max:1000',
        ]);

        // Create model instance
        $characterMatch = new CharacterMatch();

        // Count matched percentage
        $matchPercentage = $characterMatch->calculateMatchPercentage(
            $request->first_input,
            $request->second_input
        );

        // Save to db
        $savedMatch = CharacterMatch::create([
            'first_input' => $request->first_input,
            'second_input' => $request->second_input,
            'match_percentage' => $matchPercentage,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('character-match.result', $savedMatch->id);
    }

    // Show result
    public function result(CharacterMatch $characterMatch)
    {
        // Check if user owns this match
        if ($characterMatch->user_id !== Auth::id()) {
            return redirect()->route('character-match.index')->with('error', 'Unauthorized access');
        }

        return view('character-match.result', compact('characterMatch'));
    }

    // List all data
    public function list()
    {
        $matches = CharacterMatch::where('user_id', Auth::id())
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        return view('character-match.list', compact('matches'));
    }

    // Delete proccess
    public function destroy(CharacterMatch $characterMatch)
    {
        // Check if user owns this match
        if ($characterMatch->user_id !== Auth::id()) {
            return redirect()->route('character-match.list')->with('error', 'Unauthorized access');
        }

        $characterMatch->delete();

        return redirect()->route('character-match.list')->with('success', 'Match record deleted successfully');
    }
}
