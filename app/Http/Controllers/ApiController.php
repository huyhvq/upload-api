<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use \File;
use finfo;

class ApiController extends Controller
{
    public function store(Request $request)
    {
        $fileData = $request->getContent();
        if (empty($fileData)) {
            return new JsonResponse(['message' => 'Missing file data.'], 401);
        }

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = explode('/', $finfo->buffer($fileData));

        if ($mimeType[0] == 'text') {
            return new JsonResponse(['message' => 'Please send valid file data.'], 401);
        }
        $filePath = public_path(sprintf('upload/%s.%s', str_random(15), $mimeType[1]));
        File::put($filePath, $fileData);
        return new JsonResponse($this->_getFileInfo($filePath), 200);
    }

    public function show($fileName)
    {
        $file = $this->_searchFindMatching($fileName);
        if (!file) {
            return new JsonResponse(['message' => 'File not found.'], 404);
        }
        return new JsonResponse($this->_getFileInfo($file), 200);
    }

    public function destroy($fileName)
    {
        $file = $this->_searchFindMatching($fileName);
        if (!file) {
            return new JsonResponse(['message' => 'File not found.'], 404);
        }
        File::delete($file);
        return new JsonResponse(['message' => 'Delete file Successfully.'], 200);
    }

    protected function _getFileInfo($filePath)
    {
        return [
            'name'      => File::name($filePath),
            'base_name' => File::basename($filePath),
            'path'      => url(sprintf('/upload/%s', File::basename($filePath))),
            'size'      => File::size($filePath),
            'mime_type' => File::mimeType($filePath),
            'type'      => File::type($filePath),
        ];
    }

    protected function _searchFindMatching($fileName)
    {
        $filePath = public_path(sprintf('upload/%s', $fileName));
        if (!File::isFile($filePath)) {
            $file = File::glob($filePath . '.*');
            if (empty($file)) {
                return false;
            }
            $filePath = head($file);
        }
        return $filePath;
    }
}