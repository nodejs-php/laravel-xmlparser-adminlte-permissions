<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use App\Repositories\OfferRepository;
use App\Services\APIService;
use App\Services\MapperService;
use App\Services\ParserService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProductParseCommand extends Command
{
    public function __construct(
        APIService      $apiService,
        ParserService   $parserService,
        MapperService   $mapperService,
        OfferRepository $productRepository,
    )
    {
        parent::__construct();

        $this->apiService = $apiService;
        $this->parserService = $parserService;
        $this->mapperService = $mapperService;
        $this->productRepository = $productRepository;
    }

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
    private CategoryRepository $categoryRepository;
    private OfferRepository $offerRepository;

    /**
     * Выполнение команды
     */
    public function handle(): void
    {
        try {
            $url = config('api.url');
            $configFile = storage_path(env('CONFIG_PATH'));

            $responseData = $this->apiService->fetch($url);
            $data = $responseData['body'];
            $contentType = $responseData['content_type'];

            $parsedData = $this->parserService->parse($data, $contentType);

            foreach ($parsedData['products'] as $product) {
                $mappedData = $this->mapperService->map($product, $configFile);

                $imagesData = $mappedData['image'];
                unset($mappedData['image']);
                $product = $this->categoryRepository->create((array)$mappedData);

                foreach ($imagesData as $imageUrl) {
                    $this->offerRepository->create([
                        'product_id' => $product->id,
                        'image' => $imageUrl,
                    ]);
                }
            }
            $this->info( 'Товары успешно загружены, сопоставлены и сохранены.');
        } catch (\Exception $e) {
            Log::error($e);
            $this->info( 'Произошла ошибка при получении, сопоставлении или сохранении продуктов.');
        }
    }
}
