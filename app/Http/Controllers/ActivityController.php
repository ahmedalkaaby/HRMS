<?php

namespace App\Http\Controllers;

use App\Exports\ActivitiesExport;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ActivityController extends Controller
{
    public function index(): View
    {
        $activities = Activity::all();
        return view('activity.index', compact('activities'));
    }

    /**
     * @return BinaryFileResponse
     */
    public function export(): BinaryFileResponse
    {
        return Excel::download(new ActivitiesExport(), 'HRMS-activities-' . now()->toDateString() .'.xlsx');
    }
}
