<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificate;

class CertificateController extends Controller
{
    public function show($hash)
    {
        $certificate = Certificate::where('hash', $hash)
            ->with(['manuscript.author', 'manuscript.issue'])
            ->firstOrFail();

        return view('certificates.print', compact('certificate'));
    }
}
