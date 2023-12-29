<?php

namespace App\Services;

use App\Repositories\Interfaces\ParserInterface;

class XmlParser implements ParserInterface
{
    public function parse($xml): array
    {
        $xmlObject = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

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
