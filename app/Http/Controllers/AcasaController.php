<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Proiect;
use Illuminate\Support\Facades\DB;

class AcasaController extends Controller
{
    public function acasa()
    {
        // Define date ranges
        $startOfThisMonth = Carbon::now()->startOfMonth();
        $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $endOfLastMonth   = Carbon::now()->subMonth()->endOfMonth();

        // 1. Count projects by data_contract
        $allProiecteCount   = Proiect::count();
        $proiecteThisMonth  = Proiect::whereDate('data_contract', '>=', $startOfThisMonth)->count();
        $proiecteLastMonth  = Proiect::whereBetween('data_contract', [$startOfLastMonth, $endOfLastMonth])->count();

        // 2. Group projects by stare_contract (status) and get counts for each group
        $proiecteGroupedByStareContract = Proiect::select('stare_contract', DB::raw('COUNT(*) as total'))
            ->groupBy('stare_contract')
            ->get();

        return view('acasa', compact(
            'allProiecteCount',
            'proiecteThisMonth',
            'proiecteLastMonth',
            'proiecteGroupedByStareContract'
        ));
    }
}
