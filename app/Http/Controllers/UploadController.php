<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Driver;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): string
    {
        if($request->hasFile('documents')) {
            $file = $request->file('documents');
            $file_name = $file->getClientOriginalName();
            $folder = 'driver-' . $request->id;

            $file->storeAs('documents/tmp/' . $folder, $file_name);

            TemporaryFile::create([
                'folder' => $folder,
                'filename' => $file_name,
            ]);

            return $folder;
        }

        return '';
    }

    /**
     * Remove uploaded files from storage and database.
     */
    public function remove(Request $request): Response
    {
        $tmp_file = TemporaryFile::query()->where('folder', $request->getContent())->first();
        if ($tmp_file) {
            Storage::deleteDirectory('documents/tmp/' . $tmp_file->folder);
            $tmp_file->delete();
        }

        return response('');
    }
}
