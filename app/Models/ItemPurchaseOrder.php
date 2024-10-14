<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function po()
    {
        return $this->belongsTo(PurchaseOrder::class, 'no_po', 'no_po');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id');
    }
}
