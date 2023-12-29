<?php

namespace App\Console\Commands;

use App\Repositories\CategoryRepository;
use App\Repositories\OfferRepository;
use App\Services\APIService;
use App\Services\MapperService;
use App\Services\ParserService;
use Exception;
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
        OfferRepository $offerRepository,
    )
    {
        parent::__construct();

        $this->apiService = $apiService;
        $this->parserService = $parserService;
        $this->mapperService = $mapperService;
        $this->offerRepository = $offerRepository;
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
    private OfferRepository $offerRepository;

    /**
     * Выполнение команды
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            $url = config('api.url');
            $configFile = storage_path(config('api.mapped_config'));
            $responseData = $this->apiService->fetch($url);
            $data = $responseData['body'];
            $contentType = $responseData['content_type'];
            $parsedData = $this->parserService->parse($data, $contentType);

            foreach ($parsedData as $offer) {
                $mappedData = $this->mapperService->map($offer, $configFile);
                $this->offerRepository->create($mappedData);
            }
            $this->info('Товары успешно загружены, сопоставлены и сохранены.');
        } catch (\Exception $e) {
            Log::error($e);
            $this->info('Произошла ошибка при получении, сопоставлении или сохранении продуктов.');
        }
    }
}
