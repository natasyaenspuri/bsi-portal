<?php

namespace App\Livewire;

use App\Models\Rekening;
use App\Models\RequestModel;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class AdminStats extends Component
{
    public function render()
    {
        // 1. Chart Data: Request Status Distribution
        $statusCounts = RequestModel::selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
        
        $chartStatusData = [
            $statusCounts['pending'] ?? 0,
            $statusCounts['processed'] ?? 0,
            $statusCounts['rejected'] ?? 0,
        ];

        // 2. Chart Data: Account Growth (Last 7 Days)
        $sevenDaysAgo = now()->subDays(6)->startOfDay();
        // Determine DB driver to use correct date function logic if needed, 
        // but since we are on MySQL now, DATE() is standard.
        // If we want to be safe for both (in case user switches back to sqlite), we can catch exception or just use MySQL logic as requested.
        // MySQL: DATE(created_at)
        // SQLite: DATE(created_at) works too mostly if format is standard Y-m-d H:i:s, but strftime is safer.
        // Let's assume MySQL as per user request.
        
        $dailyGrowth = Rekening::selectRaw('DATE(created_at) as date, count(*) as count')
            ->where('created_at', '>=', $sevenDaysAgo)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count', 'date')
            ->toArray();
            
        $growthLabels = [];
        $growthData = [];
        for ($i = 0; $i < 7; $i++) {
            $date = now()->subDays(6 - $i)->format('Y-m-d');
            $growthLabels[] = now()->subDays(6 - $i)->format('d M');
            $growthData[] = $dailyGrowth[$date] ?? 0;
        }

        return view('livewire.admin-stats', [
            'totalRequests' => RequestModel::count(),
            'pendingRequests' => RequestModel::where('status', 'pending')->count(),
            'totalUsers' => User::where('role', 'user')->count(),
            'totalRekenings' => Rekening::count(),
            'activeRekenings' => Rekening::where('status', 'active')->count(),
            'chartStatusData' => $chartStatusData,
            'growthLabels' => $growthLabels,
            'growthData' => $growthData,
        ]);
    }
}
