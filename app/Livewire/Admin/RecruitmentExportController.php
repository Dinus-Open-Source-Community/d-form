<?php

namespace App\Livewire\Admin;

use App\Http\Controllers\Controller;
use App\Exports\RecruitmentExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RecruitmentExportController extends Controller
{
    public function __invoke(Request $request)
    {
        abort_unless(auth()->user()->can('recruitment.export'), 403);

        $filters = $request->only(['search', 'status', 'division', 'semester']);
        $filename = 'recruitment_' . now()->format('Y_m_d_His') . '.xlsx';
        
        return Excel::download(new RecruitmentExport($filters), $filename);
    }
}
