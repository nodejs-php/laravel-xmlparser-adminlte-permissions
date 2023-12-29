<?php

namespace App\Services;

use App\Repositories\Interfaces\ParserInterface;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\NoReturn;
use XMLReader;

class XmlParser implements ParserInterface
{
    #[NoReturn] public function parse(string $data): array
    {
        $file = storage_path(config('api.xml_temporary_file'));
        file_put_contents($file, $data);

        $xml = new XMLReader();
        $xml->open($file);

        $categories = [];
        $offers = [];

        $offerElements = ['url', 'price', 'oldprice', 'currencyId', 'categoryId', 'picture', 'name', 'vendor'];

        while ($xml->read()) {
            if ($xml->nodeType === XMLReader::ELEMENT && $xml->name === 'category') {
                $categories[$xml->getAttribute('id')] = [
                    'parent_id' => $xml->getAttribute('parentId'),
                    'text' => $xml->readString(),
                ];
            }

            if ($xml->nodeType === XMLReader::ELEMENT && $xml->name === 'offer') {
                $offerId = $xml->getAttribute('id');
                $offers[$offerId] = [
                    'available' => $xml->getAttribute('available'),
                ];
            }

            //Начато чтение offer
            if (isset($offerId)) {
                foreach ($offerElements as $offerElement) {
                    if ($xml->nodeType === XMLReader::ELEMENT && $xml->name === $offerElement) {
                        $offers[$offerId][$offerElement] = $xml->readString();
                    }
                }

                if ($xml->nodeType === XMLReader::ELEMENT && $xml->name === 'categoryId') {
                    $categoryId = $xml->readString();
                    $offers[$offerId]['categoryId'] = $categoryId;
                    $offers[$offerId]['category'] = $categories[$categoryId];
                }
            }
        }

        $xml->close();

        return $offers;
    }
}
