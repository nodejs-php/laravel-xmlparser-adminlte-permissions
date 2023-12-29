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
        while ($xml->read()) {
           // if ($xml->nodeType == XMLReader::END_ELEMENT) break;
            dd($xml->name);
            if ($xml->nodeType === XMLReader::ELEMENT ) {
                dd($xml->name);
            } else if ($xml->nodeType == XMLReader::TEXT) $assoc = $xml->value;
        }

        $xml->close();


        $products = [];
        foreach ($phpArray['products'] as $product) {
            if (isset($product['images']) && !is_array($product['images'])) {
                $product['images'] = [$product['images']];
            }
            $products[] = $product;
        }

        $phpArray['products'] = $products;

        return $phpArray;
    }
}
