<?php

namespace App\Http\Controllers;

use App\Models\ItemPurchaseOrder;
use App\Models\Material;
use App\Models\NotifyLog;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PurchaseOrderController extends Controller
{

    public function home()
    {
        $title = 'Home';
        return view('home', compact('title'));
    }
    public function indexUser()
    {
        $title = 'Data User';
        $data = User::all();
        return view('masterUser', compact('title', 'data'));
    }

    public function addUser(Request $request)
    {
        // dd($request);
        $user = User::create([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }


    public function updateUser(Request $request, $id)
    {
        // Find the user by id
        $user = User::find($id);

        // Update the user's name, email, and role
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Check if the password field is filled
        if ($request->filled('password')) {
            // Encrypt the new password before saving
            $user->password = Hash::make($request->password);
        }

        // Save the updated user data
        $user->save();

        // Optionally redirect or return a success message
        return redirect()->back()->with('success', 'User updated successfully');
    }


    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }

    public function indexSupplier()
    {
        $title = 'Data Supplier';
        $data = Supplier::all();
        return view('masterSupplier', compact('title', 'data'));
    }

    public function addSupplier(Request $request)
    {
        // dd($request);
        $supp = Supplier::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
        ]);
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }

    public function updateSupplier(Request $request, $id)
    {
        // dd($request);
        $supp = Supplier::find($id);
        $supp->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
        ]);
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }

    public function deleteSupplier($id)
    {
        // dd($request);
        $supp = Supplier::find($id);
        $supp->delete();
        return redirect()->back()->with('succes', 'Data Berhasil Dihapus');
    }

    public function indexMaterial()
    {
        $title = 'Data Material';
        $data = Material::all();
        return view('masterMaterial', compact('title', 'data'));
    }

    public function addMaterial(Request $request)
    {
        // dd($request);
        $material = Material::create([
            'id' => $request->kode_produk,
            'name' => $request->name,
            'price' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }

    public function modalDetailMaterial($id)
    {
        // $title = 'Detail Purchase Order';
        $mat = Material::find($id);
        return view('modalDetailMaterial', compact('mat'));
    }

    public function updateMaterial(Request $request, $id)
    {
        // dd($request);
        $material = Material::find($id);
        $material->update([
            'name' => $request->name,
        ]);
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }

    public function deleteMaterial($id)
    {
        // dd($request);
        $material = Material::find($id);
        $material->delete();
        return redirect()->back()->with('success', 'Data Berhasil Dihapus');
    }


    public function modalDetailUser($id)
    {
        // $title = 'Detail Purchase Order';
        $data = user::find($id);
        return view('modalDetailUser', compact('data'));
    }

    public function modalDetailSupplier($id)
    {
        // $title = 'Detail Purchase Order';
        $supp = Supplier::find($id);
        return view('modalDetailSupplier', compact('supp'));
    }


    public function indexPO()
    {
        $title = 'Data Purchase Order';
        $supp = Supplier::all();
        $mat = Material::all();
        $dataPO = PurchaseOrder::all();
        return view('purchaseOrder', compact('title', 'supp', 'mat', 'dataPO'));
    }

    public function addPO(Request $request)
    {
        // Get current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Define month to Roman numeral mapping
        $romanMonths = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ];

        // Get the Roman numeral for the current month
        $monthRoman = $romanMonths[$currentMonth];

        // Count the number of POs created this month
        $poCount = PurchaseOrder::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        // Increment the PO count for the new PO
        $poNumber = str_pad($poCount + 1, 3, '0', STR_PAD_LEFT); // E.g., 001, 002, 003

        // Construct the PO number (e.g., 1445/RMA/XII/PO/001)
        $formattedPoNumber = "1445/RMA/{$monthRoman}/PO/{$poNumber}";
        $count = count($request->itemValue);
        $po =   PurchaseOrder::create([
            'no_po' =>  $formattedPoNumber,
            'tgl_pembuatan' => $request->tanggal_pembuatan,
            'tgl_pengiriman' => $request->tanggal_pengiriman,
            'supplier_id' => $request->supplier,
            'status' => 'Menunggu Validasi Kepala Purchasing'
        ]);

        for ($i = 0; $i < $count; $i++) {
            ItemPurchaseOrder::create([
                'no_po' => $po->no_po,
                'material_id' => $request->itemValue[$i],
                'qty' => $request->qty[$i],
                'total_price' => $request->total_price[$i],
            ]);
        }
        return redirect()->back()->with('success', 'Informasi added successfully.');
    }

    public function indexDetailPO($po)
    {
        // $po =  // Split the short PO (e.g., X-001) into month and number
        [$month, $number] = explode('-', $po);

        // Search for the full PO using the month and number
        $fullPO = PurchaseOrder::whereRaw("REPLACE(no_po, '/', '') LIKE ?", ["%$month%$number"])->first();

        if (!$fullPO) {
            return abort(404, 'Purchase Order not found.');
        }
        $title = 'NO PO: ' . $fullPO->no_po;
        $mat = Material::all();
        $supp = Supplier::all();
        $itemPO = ItemPurchaseOrder::where('no_po', $fullPO->no_po)->get();
        $noPO = $po;
        return view('detailPO', compact('title', 'supp', 'mat', 'fullPO', 'itemPO', 'noPO'));
    }

    public function rejectPO(Request $request, $po)
    {
        // $po =  // Split the short PO (e.g., X-001) into month and number
        [$month, $number] = explode('-', $po);

        // Search for the full PO using the month and number
        $fullPO = PurchaseOrder::whereRaw("REPLACE(no_po, '/', '') LIKE ?", ["%$month%$number"])->first();

        if (!$fullPO) {
            return abort(404, 'Purchase Order not found.');
        }

        $fullPO->update([
            'status' => 'Revisi',
            'notes' => $request->notes
        ]);
        return redirect()->back()->with('success', 'Pyrchase Order Update successfully.');
    }

    public function editPO(Request $request, $po)
    {
        // $po =  // Split the short PO (e.g., X-001) into month and number
        [$month, $number] = explode('-', $po);

        // Search for the full PO using the month and number
        $fullPO = PurchaseOrder::whereRaw("REPLACE(no_po, '/', '') LIKE ?", ["%$month%$number"])->first();

        if (!$fullPO) {
            return abort(404, 'Purchase Order not found.');
        }

        $fullPO->update([
            // 'no_po' =>  $formattedPoNumber,
            'tgl_pembuatan' => $request->tanggal_pembuatan,
            'tgl_pengiriman' => $request->tanggal_pengiriman,
            'supplier_id' => $request->supplier,
            'status' => 'Revisi 1'
        ]);

        $itemPO = ItemPurchaseOrder::where('no_po', $fullPO->no_po)->get();
        $count = $itemPO->count();
        $i = 0;
        foreach ($itemPO as $item) {
            $item->update([
                // 'no_po' => $po->no_po,
                'material_id' => $request->itemValue[$i],
                'qty' => $request->qty[$i],
                'total_price' => $request->total_price[$i],
            ]);
            $i = $i + 1;
        }


        return redirect()->back()->with('success', 'Pyrchase Order Update successfully.');
    }


    // API
    public function getPrice($id)
    {
        $material = Material::find($id);

        return $material;
    }

    public function getNotif($id)
    {
        $dataUser = User::find($id);

        if (!$dataUser) {
            return response()->json([], 404); // Handle user not found
        }

        $user = Supplier::where('email', $dataUser->email)->first();

        if (!$user) {
            return response()->json([], 404); // Handle supplier not found
        }

        // Get all notifications with 'Belum dibuka' status
        $notif = NotifyLog::where('receiver', $user->email)
            ->where('status', 'Belum dibuka')
            ->get();

        // Format each notification with short PO
        $data = $notif->map(function ($key) {
            $parts = explode('/', $key->no_po);
            $shortPO = "{$parts[2]}-{$parts[4]}"; // Example: "X-001"

            return [
                'data' => $key,
                'short_po' => $shortPO,
            ];
        });

        return response()->json($data); // Return as JSON array
    }



    public function accPO($po)
    {
        // $po =  // Split the short PO (e.g., X-001) into month and number
        [$month, $number] = explode('-', $po);

        // Search for the full PO using the month and number
        $fullPO = PurchaseOrder::whereRaw("REPLACE(no_po, '/', '') LIKE ?", ["%$month%$number"])->first();

        if (!$fullPO) {
            return abort(404, 'Purchase Order not found.');
        }

        $fullPO->update([
            'status' => 'Telah Divalidasi Kepala Purchasing'
        ]);
    }
    public function sendPOtoSupp($po, $user)
    {
        // $po =  // Split the short PO (e.g., X-001) into month and number
        [$month, $number] = explode('-', $po);

        // Search for the full PO using the month and number
        $fullPO = PurchaseOrder::whereRaw("REPLACE(no_po, '/', '') LIKE ?", ["%$month%$number"])->first();

        if (!$fullPO) {
            return abort(404, 'Purchase Order not found.');
        }

        $fullPO->update([
            'status' => 'Terkirim ke Supplier'
        ]);

        $supp = Supplier::find($fullPO->supplier_id);
        $user = User::find($user);
        //Send Notify
        NotifyLog::create(
            [
                'no_po' => $fullPO->no_po,
                'sender' => $user->email,
                'receiver' => $supp->email,
                'status' => 'Belum dibuka'
            ]
        );
    }
}
