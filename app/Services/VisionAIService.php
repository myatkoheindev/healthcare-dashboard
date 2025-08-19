<?php

namespace App\Services;

use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Likelihood;

class VisionAIService
{
    public function extractText(string $imagePath)
    {
        $client = new ImageAnnotatorClient;

        // Load image
        $content = file_get_contents($imagePath);
        $image = (new Image)->setContent($content);

        // Set detection type
        $feature = (new Feature)->setType(Feature\Type::DOCUMENT_TEXT_DETECTION);

        // Create request
        $request = (new AnnotateImageRequest)
            ->setImage($image)
            ->setFeatures([$feature]);

        $batchRequest = (new BatchAnnotateImagesRequest)
            ->setRequests([$request]);

        // Call Vision API
        $batchResponse = $client->batchAnnotateImages($batchRequest);

        $results = [];
        foreach ($batchResponse->getResponses() as $response) {
            foreach ($response->getFaceAnnotations() as $faceAnnotation) {
                $likelihood = Likelihood::name($faceAnnotation->getHeadwearLikelihood());
                $results[] = "Text: {$likelihood}";
            }
        }

        $client->close();
    }
}
