<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pemesanan;
use App\PemesananDetail;
use App\DaftarMenu;

use Carbon\Carbon;

class PemesananController extends Controller
{
    private $carbon;

    public function __construct(){
        $this->carbon = new Carbon;
    }
    public function add(){
        $count_pemesanan = Pemesanan::withTrashed()->count();
        $no_pemesanan = 'ERP' . $this->carbon->format('dmY') . "-" . sprintf('%03d', $count_pemesanan + 1);

        return response()->json($no_pemesanan);
    }

    public function paginate()
    {
        $daftarmenus = DaftarMenu::orderBy('nama_menu', 'ASC')
            ->paginate(request('limit', 10));
        if (request()->all()) {
            $daftarmenus->appends(request()->all());
        }

        return response()->json($daftarmenus);
    }

    public function view()
    {
        return view('view');
    }
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name'  => 'required|string|max:50',
        //     'email' => 'required|email|unique:users,email',
        // ]);
        if (is_null($request->id_menu)) {
            $daftarmenu     = DaftarMenu::create([
            'nama_menu'     => $request->nama_menu,
            'desk_menu'     => '',
            'jenis_menu'    => $request->jenis_menu,
            'harga'         => $request->harga,
            'status_menu'   => $request->status_menu
            ]);
        } else {
            $daftarmenu = DaftarMenu::find($request->id_menu);
            $daftarmenu->nama_menu      = $request->nama_menu;
            $daftarmenu->desk_menu      = '';
            $daftarmenu->jenis_menu     = $request->jenis_menu;
            $daftarmenu->harga          = $request->harga;
            $daftarmenu->status_menu    = $request->status_menu;
            $daftarmenu->save();
        }
        
        return response()->json($daftarmenu);
    }
    public function show($id_menu)
    {
        $daftarmenu = DaftarMenu::find($id_menu);
        if (is_null($daftarmenu)) {
            return response()->json([
                'message' => 'Daftar Menu Tidak Ditemukan.',
            ], 404);
        }
        return response()->json($daftarmenu);
    }

    public function delete($id_menu)
    {
        $daftarmenu = DaftarMenu::find($id_menu);
        if (is_null($daftarmenu)) {
            return response()->json([
                'message' => 'Daftar Menu Tidak Ditemukan.',
            ], 404);
        } else {
            $daftarmenu->delete();
        }
        return response()->json($daftarmenu);
    }

    public function search($val = ''){
        if (!empty($val)) {
            $daftarmenus = DaftarMenu::where('nama_menu','like','%' . $val . '%')
            ->orWhere('jenis_menu','like','%' . $val . '%')
            ->orWhere('harga','like','%' . $val . '%')
            ->orWhere('status_menu','like','%' . $val . '%')
            ->orderBy('nama_menu', 'ASC')
            ->paginate(request('limit', 10));
            if (request()->all()) {
                $daftarmenus->appends(request()->all());
            }
        } else {
            $daftarmenus = DaftarMenu::orderBy('nama_menu', 'ASC')
                ->paginate(request('limit', 1));
            if (request()->all()) {
                $daftarmenus->appends(request()->all());
            }
        }

        return response()->json($daftarmenus);
    }
}
