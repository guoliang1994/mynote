<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * 附件上传
     * @param Request $request
     * @return array
     */
    public function attachment(Request $request): array
    {
        $path = $request->file('file')->store('attachment');
        return ['code' => 20000, 'path' => $path];
    }

    /**
     * 头像上传
     * @param Request $request
     * @return array
     */
    public function avatar(Request $request): array
    {
        $path = $request->file('file')->store('avatar');
        return ['code' => 20000, 'path' => $path];
    }
}
