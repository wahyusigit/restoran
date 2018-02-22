<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Pemesanan;
use App\PemesananDetail;
use App\DaftarMenu;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $role = new Role();
    	// $role->name = 'pelayan';
    	// $role->description = 'user pelayan';
    	// $role->save();

    	// $role = new Role();
    	// $role->name = 'kasir';
    	// $role->description = 'user kasir';
    	// $role->save();

    	// $id_role_kasir = Role::where('name','kasir')->first()->id_role;
    	// $id_role_pelayan = Role::where('name','pelayan')->first()->id_role;

    	$user = new User();
        $user->name = 'pelayan 1';
		// $user->id_role = $id_role_kasir;
		$user->name = 'pelayan1';
		$user->email = 'pelayan1@pelayan1.com';
		$user->password = bcrypt('pelayan1');
		$user->save();

		$user = new User();
		$user->name = 'kasir 1';
		// $user->id_role = $id_role_kasir;
		$user->name = 'kasir1';
		$user->email = 'kasir1@kasir1.com';
		$user->password = bcrypt('kasir1');
		$user->save();

        // $limit = 300;
        // $jenis_menus = ['makanan','minuman'];

        // $hargas = [1000,2000,3000,4000,5000,6000,7000,9000];

        // for ($i=1; $i <= $limit; $i++) { 
        //     $jenis = array_random($jenis_menus);
        //     $menu = new Menu();
        //     $menu->nama_menu = $jenis . ' ' . $i;
        //     $menu->desk_menu = $jenis . ' ' . $i;
        //     $menu->jenis_menu = $jenis;
        //     $menu->status_menu = 'ready';
        //     $menu->harga = array_random($hargas);
        //     $menu->save();
        // }

        $data_makanan = [
                            ["Spaghetti Bolognaise","19273"],
                            ["French Fries","15728"],
                            ["Mie Ayam Teriyaki","23819"],
                            ["Nasi + mie ayam teriyaki saos","25728"],
                            ["Mie +ayam katsu Teriyaki saos","25728"],
                            ["Nasi + sapo tahu seafood","29364"],
                            ["Chicken Cordon Bleu","34819"],
                            ["Chicken Mozarella","34819"],
                            ["Chicken Steak Chessy","34819"],
                            ["Fish& chips","39273"],
                            ["Kwetiau ayam","21000"],
                            ["Kwetiau Ayam bakso","22000"],
                            ["kwetiau Goreng Ayam","23000"],
                            ["Kwetiau Ayam siram","24000"],
                            ["Kwetiau Sapi Goreng","25000"],
                            ["Kwetiau Seafood Goreng","26000"],
                            ["Kwetiau Seafood Siram","27000"],
                            ["Bihun Ayam","19000"],
                            ["Bihun ayam bakso","20000"],
                            ["Bihun Goreng Ayam","21000"],
                            ["Bihun Siram ayam","22000"],
                            ["Bihun Kuah ayam","23000"],
                            ["Bihun Goreng Sapi","24000"],
                            ["Bihun Seafood","25000"],
                            ["Bakso urat Mie","18000"],
                            ["Bakso Halus Mie","18500"],
                            ["Bakso Campur mie","19000"],
                            ["Lo Mie","27000"],
                            ["I Fu Mie","28000"],
                            ["I Fu Mie Seafood","29000"],
                            ["Mie ayam","19000"],
                            ["Mi Goreng Ayam","22000"],
                            ["Mie Kuah Ayam","22000"],
                            ["Mie Goreng Sapi","26000"],
                            ["Mie Goreng Seafood","26000"],
                            ["Smoked Chicken Fried Rice","30000"],
                            ["Nasi Goreng","23000"],
                            ["Nasi Goreng Spesial","27000"],
                            ["Nasi Goreng Seafood","29000"],
                            ["Nasi Goreng udang","29000"],
                            ["Nasi Goreng Kepiting Rajungan","29000"],
                            ["Nasi Goreng Modern","29000"],
                            ["Nasi Goreng Petai","28000"],
                            ["Nasi Goreng Sosis","29000"],
                            ["Nasi Goreng Teri Medan","29000"],
                            ["Nasi Cap cay","26000"],
                            ["Nasi Ayam Cah Jamur","27000"],
                            ["Nasi Aayam Cah Kapri","28000"],
                            ["Nasi Cap cay seafood","29000"],
                            ["Nasi Fu yung Hai","30000"],
                            ["Nasi Bistik Ayam","31000"],
                            ["Nasi Bistik Sapi","32000"],
                            ["Soup Ayam","19000"],
                            ["Nasi Putih","6000"],
                            ["Ayam Goreng Mentega/tepung/rica","33000"],
                            ["Ayam Nanking","33500"],
                            ["Cumi goreng mentega","34000"],
                            ["Fillet Ikan Goreng","34500"],
                            ["Udang Goreng Tepung","35000"]
        ];

        foreach ($data_makanan as $value) {
            $menu = new DaftarMenu();
            $menu->nama_menu = $value[0];
            $menu->desk_menu = $value[0];
            $menu->jenis_menu = 'makanan';
            $menu->status_menu = 'ready';
            $menu->harga = $value[1];
            $menu->save();
        }

        $data_minuman = [
                            ["Teh Tarik","15000"],
                            ["Orange Juice","16000"],
                            ["Black CUrrant","17000"],
                            ["Frozen capucino","18000"],
                            ["Milkshake Strawberry","19000"],
                            ["Juice Alpukat/melon/sirsak/tomat","20000"],
                            ["Es Jeruk","7000"],
                            ["Es lemon tea","12000"],
                            ["Es lemonade","12000"],
                            ["Ice Gren tea","12000"],
                            ["Coca-cola/fanta","8000"],
                            ["Teh Botol Sosro","7500"],
                            ["Air Mineral","6500"],
                            ["Es teh tawar","4500"],
                            ["Es teh Manis","5500"],
                            ["Es Batu","1000"]
        ];

        foreach ($data_minuman as $value) {
            $menu = new DaftarMenu();
            $menu->nama_menu = $value[0];
            $menu->desk_menu = $value[0];
            $menu->jenis_menu = 'minuman';
            $menu->status_menu = 'ready';
            $menu->harga = $value[1];
            $menu->save();
        }
    }
}
