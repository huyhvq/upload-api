<?php

class ApiTest extends TestCase
{
    public function test_upload_file()
    {
        $this->call('POST', '/api', ['name' => 'dota2-example.jpg'], [], [], [], file_get_contents(public_path('dota.jpg')));
        $this->assertFileExists(public_path('upload/dota2-example.jpg'));
    }

    public function test_retrieve_file()
    {
        $fileName = 'dota2-example.jpg';
        $filePath = public_path('upload/' . $fileName);
        $response = [
            'name'      => File::name($filePath),
            'base_name' => File::basename($filePath),
            'url'       => route('api.file', File::basename($filePath)),
            'size'      => File::size($filePath),
            'mime_type' => File::mimeType($filePath),
            'type'      => File::type($filePath),
        ];
        $this->get('/api/' . $fileName)->seeJson($response);
    }

    public function test_delete_file()
    {
        $fileName = 'dota2-example.jpg';
        $filePath = public_path('upload/' . $fileName);
        $this->delete('/api/' . $fileName)->seeJson(['message' => 'Delete file Successfully.']);
        $this->assertFileNotExists($filePath);
    }
}
