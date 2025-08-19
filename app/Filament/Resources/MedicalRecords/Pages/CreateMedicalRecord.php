<?php

namespace App\Filament\Resources\MedicalRecords\Pages;

use App\Filament\Resources\MedicalRecords\MedicalRecordResource;
use App\Models\MedicalRecord;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CreateMedicalRecord extends CreateRecord
{
    protected static string $resource = MedicalRecordResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $filePath = Storage::disk('public')->path($data['medical_image']);

        $response = Http::attach(
            'file', file_get_contents($filePath), basename($filePath)
        )->timeout(60)
            ->post(env('HEALTHCARE_API_URL').'/ocr');

        $data = $response->json();

        return MedicalRecord::create([
            'medical_image' => $data['medical_image'],
            'ocr_text' => $data['ocr'] ?? null,
            'genai_result' => $data['genai'] ?? null,
        ]);
    }
}
