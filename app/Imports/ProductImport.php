<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $row
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Get product
            $product = Product::where('product_id', $row['product_id'])->first();

            // Check if product status == sold decrement quantity by 1 || if product status == sold increment quantity by 1
            if (strtoupper($row['status']) == 'SOLD') {
                $product->quantity = $product->quantity - 1;
            } elseif (strtoupper($row['status']) == 'BUY') {
                $product->quantity = $product->quantity + 1;
            }
            $product->save();
        }
    }
}
