<?php


namespace App\Contracts;


use Illuminate\Foundation\Http\FormRequest;

interface RestServiceContract
{
    public function get($id);
    public function get_all();
    public function create(FormRequest $request);
    public function delete($id);
}
