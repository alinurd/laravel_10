<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CRUDRequest extends FormRequest
{
    protected $customRules = [];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return $this->customRules;
    }

    public function setRules(array $rules): void
    {
        $this->customRules = $rules;
    }
}

