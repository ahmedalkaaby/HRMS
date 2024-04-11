<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
        return Excel::download(new UsersExport(), 'HRMS-users-' . now()->toDateString() .'.xlsx');
    }
}
