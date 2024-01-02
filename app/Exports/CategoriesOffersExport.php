<?php

namespace App\Exports;

use App\Models\CategoriesOffers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoriesOffersExport implements FromQuery, WithHeadings, WithStyles
{
    use Exportable;

    public function query(): Relation|Builder|\Laravel\Scout\Builder|\Illuminate\Database\Query\Builder
    {
        return CategoriesOffers::query()->select(['category_id',
            'parent_id',
            'category_name',
            'offer_id',
            'available',
            'url',
            'price',
            'old_price',
            'currency_id',
            'picture',
            'offer_name',
            'vendor',
            'created_at',
            'updated_at',]);
    }

    public function headings(): array
    {
        return [
            'Category Id',
            'Parent Id',
            'Category Name',
            'Offer Id',
            'Available',
            'url',
            'price',
            'old_price',
            'currency_id',
            'picture',
            'offer_name',
            'vendor',
            'Created At',
            'Updated At'
        ];
    }

    public function fields(): array
    {
        return [
            'category_id',
            'parent_id',
            'category_name',
            'offer_id',
            'available',
            'url',
            'price',
            'old_price',
            'currency_id',
            'picture',
            'offer_name',
            'vendor',
            'created_at',
            'updated_at',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]]
        ];
    }
}
