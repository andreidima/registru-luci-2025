<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProiectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Return true if the user is allowed to make this request
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'denumire_contract' => 'nullable|string|max:255',
            'nr_contract' => 'nullable|string|max:100',
            'data_contract' => 'nullable|date',
            'data_limita_predare' => 'nullable|string|max:5000',
            'nr_proces_verbal_predare_primire' => 'nullable|string|max:100',
            'data_proces_verbal_predare_primire' => 'nullable|date',
            'stare_contract' => 'nullable|string|max:100',
            'cu' => 'nullable|string|max:5000',
            'studii_teren' => 'nullable|string|max:5000',
            'avize' => 'nullable|string|max:5000',
            'faza' => 'nullable|string|max:5000',
            'arhitectura' => 'nullable|string|max:5000',
            'rezistenta' => 'nullable|string|max:5000',
            'instalatii' => 'nullable|string|max:5000',
            'partea_economica' => 'nullable|string|max:5000',
            'autorizatie_de_construire' => 'nullable|string|max:5000',
            'observatii' => 'nullable|string|max:5000',

            // Add this rule for membri
            'membri_ids' => 'nullable|array',
            'membri_ids.*' => 'exists:membri,id', // ensure each ID exists in 'membri' table

            // Add this rule for subcontractanti
            'subcontractanti_ids' => 'nullable|array',
            'subcontractanti_ids.*' => 'exists:subcontractanti,id', // ensure each ID exists in 'subcontractanti' table
        ];
    }
}
