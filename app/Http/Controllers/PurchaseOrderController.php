<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function indexUser()
    {
        $title = 'Data User';
        return view('masterUser', compact('title'));
    }
    public function indexSupplier()
    {
        $title = 'Data Supplier';
        return view('masterSupplier', compact('title'));
    }
    public function indexMaterial()
    {
        $title = 'Data Material';
        return view('masterMaterial', compact('title'));
    }

    public function modalDetailMaterial()
    {
        // $title = 'Detail Purchase Order';
        return view('modalMaterial', compact('title'));
    }


    public function indexPO()
    {
        $title = 'Data Purchase Order';
        return view('purchaseOrder', compact('title'));
    }

    public function indexDetailPO()
    {
        $title = 'Detail Purchase Order';
        return view('purchaseOrder', compact('title'));
    }
}
