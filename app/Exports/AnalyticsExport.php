<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;

class AnalyticsExport implements WithMultipleSheets
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function sheets(): array
    {
        return [
            new SummarySheet($this->data),
            new TopItemsSheet($this->data),
            new TablePerformanceSheet($this->data),
        ];
    }
}

class SummarySheet implements FromCollection, WithHeadings, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect([
            [
                'Total Revenue' => '₹' . number_format($this->data['totalRevenue']),
                'Total Orders' => $this->data['totalOrders'],
                'Avg Order Value' => '₹' . number_format($this->data['averageOrderValue']),
                'Items Sold' => $this->data['totalItemsSold'],
                'Completion Rate' => number_format($this->data['completionRate'], 1) . '%',
            ]
        ]);
    }

    public function headings(): array
    {
        return ['Total Revenue', 'Total Orders', 'Avg Order Value', 'Items Sold', 'Completion Rate'];
    }

    public function title(): string
    {
        return 'Summary';
    }
}

class TopItemsSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data['topItems'])->map(function ($item) {
            return [
                'Item' => $item->name,
                'Quantity Sold' => $item->total_quantity,
                'Revenue' => '₹' . number_format($item->total_revenue),
            ];
        });
    }

    public function headings(): array
    {
        return ['Item', 'Quantity Sold', 'Revenue'];
    }

    public function title(): string
    {
        return 'Top Items';
    }
}

class TablePerformanceSheet implements FromCollection, WithHeadings, WithTitle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data['tablePerformance'])->map(function ($table) {
            return [
                'Table' => $table->table_name,
                'Orders' => $table->order_count,
                'Revenue' => '₹' . number_format($table->total_revenue),
                'Avg Order' => '₹' . number_format($table->avg_order),
            ];
        });
    }

    public function headings(): array
    {
        return ['Table', 'Orders', 'Revenue', 'Avg Order'];
    }

    public function title(): string
    {
        return 'Table Performance';
    }
}
