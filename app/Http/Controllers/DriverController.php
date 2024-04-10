<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\TemporaryFile;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index(): View
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create(): View
    {
        return view('drivers.form');
    }

    public function edit(Driver $driver): View
    {
        $attachments = Attachment::where('driver_id', $driver->id)->where('attachment_type', 'document')->get();

        return view('drivers.form', compact('driver', 'attachments'));
    }

    /**
     * @param $id
     * @param $column
     * @return RedirectResponse
     */
    public function approveOrReject($id, $column): RedirectResponse
    {
        $driver = Driver::findOrFail($id);
        $driver->$column = now();
        $driver->save();

        session()->flash('message', 'Driver has been ' . ($column === 'approved_at' ? 'approved' : 'rejected') .' successfully!');
        return Redirect::back();
    }

    public function store(Request $request): RedirectResponse
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email',
            'dob' => 'date|nullable',
            'driver_license' => 'date|nullable',
            'vehicle_type' => 'string|nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $driver = new Driver();
        $driver->fill($validated_data);
        $driver->save();

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatar_path = $avatar->store('avatars', 'public');

            $avatar_attachment = new Attachment([
                'driver_id' => $driver->id,
                'file_path' => $avatar_path,
                'attachment_type' => 'avatar',
                'mime_type' => $avatar->getMimeType(),
            ]);

            $avatar_attachment->save();
        }

        session()->flash('message', 'New driver has been created successfully!');

        return redirect()->route('drivers.index');
    }

    public function update(Request $request, Driver $driver): RedirectResponse
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:drivers,email,'.$driver->id,
            'dob' => 'date|nullable',
            'driver_license' => 'date|nullable',
            'vehicle_type' => 'string|nullable',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $driver->fill($validated_data);

        $driver->save();

        if ($request->hasFile('avatar')) {
            if ($driver->avatar) {
                Storage::disk('public')->delete($driver->avatar->file_path);
                $driver->avatar->delete();
            }

            $avatar = $request->file('avatar');
            $avatar_path = $avatar->store('avatars', 'public');

            $avatar_attachment = new Attachment([
                'driver_id' => $driver->id,
                'file_path' => $avatar_path,
                'attachment_type' => 'avatar',
                'mime_type' => $avatar->getMimeType(),
            ]);

            $avatar_attachment->save();
        }

        $documents = TemporaryFile::query()->where('folder', $request->documents)->get();
        if ($documents->count() > 0) {
            $path = storage_path('app/public/documents/tmp/' . $request->documents);
            $files = File::files($path);
            foreach ($files as $file) {
                $tmp_path = 'documents/tmp/' . $request->documents . '/' . $file->getFilename();
                $new_path = 'documents/' . $request->documents . '/' . $file->getFilename();

                Storage::copy($tmp_path , $new_path);

                Attachment::updateOrCreate([
                    'driver_id' => $driver->id,
                    'file_path' => $new_path,
                    'attachment_type' => 'document',
                    'mime_type' => mime_content_type($file->getRealPath()),
                ]);
            }

            Storage::deleteDirectory('documents/tmp/' . $request->documents);
            $documents->each(function ($record) {
                $record->delete();
            });
        }

        session()->flash('message', 'Driver information has been updated successfully!');

        return redirect()->route('drivers.index');
    }

    /**
     * @param Request $request
     * @param Driver $driver
     * @return RedirectResponse
     */
    public function delete(Request $request, Driver $driver): RedirectResponse
    {
        $driver->delete();

        session()->flash('message', 'Driver has been deleted successfully!');

        return Redirect::back();
    }
}
