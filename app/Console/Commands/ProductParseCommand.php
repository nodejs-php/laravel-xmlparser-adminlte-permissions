<?php

namespace App\Console\Commands;

use App\Repositories\ProductImagesRepository;
use App\Repositories\ProductRepository;
use App\Services\APIService;
use App\Services\MapperService;
use App\Services\ParserService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductParseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products-load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Загружает продукты';

    private APIService $apiService;
    private ParserService $parserService;
    private MapperService $mapperService;
    private ProductRepository $productRepository;

    public function __construct(
        APIService              $apiService,
        ParserService           $parserService,
        MapperService           $mapperService,
        ProductRepository       $productRepository,
    )
    {
        $this->apiService = $apiService;
        $this->parserService = $parserService;
        $this->mapperService = $mapperService;
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
    }

    public function fetchData(): JsonResponse
    {
        try {
            // Fetch data and parse it.
            $url = env('API_URL');
            $configFile = storage_path(env('CONFIG_PATH'));

            $responseData = $this->apiService->fetch($url);
            $data = $responseData['body'];
            $contentType = $responseData['content_type'];

            $parsedData = $this->parserService->parse($data, $contentType);

            // Map and store data.
            foreach ($parsedData['products'] as $product) {
                $mappedData = $this->mapperService->map($product, $configFile);

                // Separate images data and save product and images data.
                $imagesData = $mappedData['image'];
                unset($mappedData['image']);
                $product = $this->productRepository->create((array)$mappedData);

                foreach ($imagesData as $imageUrl) {
                    $this->productImagesRepository->create([
                        'product_id' => $product->id,
                        'image' => $imageUrl,
                    ]);
                }
            }
            return response()->json(['message' => 'Products fetched, mapped and saved successfully']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['message' => 'An error occurred while fetching, mapping, or saving the products.'], 500);
        }
    }

    public function getAllProducts(): Application|Response|JsonResponse|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $products = $this->productRepository->getAll();

        if (request()->wantsJson() || request()->accepts('application/json')) {
            return response()->json($products);
        } elseif (request()->accepts('text/xml') || request()->accepts('application/xml')) {
            // Build XML and return it.
            $xml = new \SimpleXMLElement('<root/>');
            foreach ($products->toArray() as $item) {
                $product = $xml->addChild('product');
                foreach ($item as $key => $value) {
                    if ($key == 'images') {
                        $images = $product->addChild('images');
                        foreach ($value as $image) {
                            $images->addChild('image', $image['image']);
                        }
                    } else if (!is_array($value)) {
                        $product->addChild($key, htmlspecialchars((string)$value));
                    }
                }
            }
            return response($xml->asXML(), 200, ['Content-Type' => 'application/xml']);
        }

        // Default response format is JSON.
        return response()->json($products);
    }
}
