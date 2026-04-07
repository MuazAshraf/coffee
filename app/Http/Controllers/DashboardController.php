<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $weekStart = now()->startOfWeek();

        $stats = $user->brews()
            ->selectRaw('COUNT(*) as total_brews')
            ->selectRaw('COALESCE(AVG(rating), 0) as avg_rating')
            ->selectRaw('SUM(CASE WHEN brewed_at >= ? THEN 1 ELSE 0 END) as this_week', [$weekStart])
            ->first();

        $totalBrews = (int) $stats->total_brews;
        $avgRating = round((float) $stats->avg_rating, 1);
        $thisWeek = (int) $stats->this_week;

        $weeklyRows = $user->brews()
            ->where('brewed_at', '>=', $weekStart)
            ->selectRaw('DATE(brewed_at) as day, COUNT(*) as count')
            ->groupBy('day')
            ->pluck('count', 'day');

        $weeklyCounts = collect(range(0, 6))->map(function ($i) use ($weekStart, $weeklyRows) {
            $day = $weekStart->copy()->addDays($i);
            return [
                'label' => $day->format('D')[0],
                'count' => (int) ($weeklyRows[$day->toDateString()] ?? 0),
            ];
        });

        $beansCount = $user->beans()->count();

        $recentBrews = $user->brews()
            ->with('bean')
            ->latest('brewed_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBrews',
            'avgRating',
            'thisWeek',
            'weeklyCounts',
            'beansCount',
            'recentBrews'
        ));
    }
}
