<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::select('id', 'name', 'icon', 'controller', 'status', 'view', 'route','route_name','group')->get()->toArray();
        $data['menus'] = $menus;
        return view('Admin.menu', $data);
    }

    public function add_menu($id = '')
    {
        if ($id != '') {
            $data['menus'] = Menu::select('id', 'name', 'icon', 'controller', 'status', 'view', 'route','route_name','group')->where('id', $id)->get()->toArray();
            return view('Admin.form.menu', $data);
        } else {
            return view('Admin.form.menu');
        }
    }

    public function save_menu($id = '', Request $request)
    {
        if ($id == '') {
            $validated = $request->validate([
                'menu_name' => 'required|unique:admin_menu,name',
                'menu_icon' => 'required',
                'menu_controller' => 'required',
                'view_file' => 'required',
                'menu_route'  => 'required|unique:admin_menu,route',
                'menu_route_name'  => 'required|unique:admin_menu,route_name',
            ]);
            dd($validated->error);
            $menu = array(
                'name' => $request->post('menu_name'),
                'icon' => $request->post('menu_icon'),
                'controller' => $request->post('menu_controller'),
                'status' => $request->post('status'),
                'view' => $request->post('view_file'),
                'route'  => $request->post('menu_route'),
                'route_name'  => $request->post('menu_route_name'),
                'group'  => $request->post('menu_route_group'),
            );
            // Add Route
            $this_new_route = "// ".$menu['route_name'] ."-start \n";
            $this_new_route .= "Route::any('/". $menu['route'] . "', '". $menu['controller'] . "@index')->name('". $menu['route_name'] . "');\n";
            $this_new_route .= "// ".$menu['route_name'] ."-end \n";
            $this_new_route .= "//".$menu['group']."//\n";
            $web_route = file_get_contents(base_path() . '\routes\web.php');
            $web_route = str_replace('//'.$menu['group'].'//',$this_new_route,$web_route);
            file_put_contents(base_path() . '\routes\web.php',$web_route);

            // Add Controller   
            $data['controller'] = base_path() . '\app\Http\Controllers'. DIRECTORY_SEPARATOR . $menu['controller'] . '.php';
            $data['comnt_name'] = explode('/',$menu['controller']);
            $contss = array_reverse($data['comnt_name']);
            $data['comnt_name'] = $contss[0];
            unset($contss[0]);
            $contss = array_reverse($contss);
            $data['path'] = '';
            foreach ($contss as $key => $cpath) {
                $data['path'] .= '\\';
                $data['path'] .= $cpath;
            }
            $fh = fopen($data['controller'], 'w') or die("Can't create file");
            $data['cont_data'] = "<?php\n\n";
            $data['cont_data'] .= "namespace App\Http\Controllers".$data['path'].";\n\n";
            $data['cont_data'] .= "use App\Http\Controllers\Controller;\n";
            $data['cont_data'] .= "use Illuminate\Http\Request;\n\n";
            $data['cont_data'] .= "class ".$data['comnt_name']." extends Controller\n";
            $data['cont_data'] .= "{\n";
            $data['cont_data'] .= "\tpublic function index(){\n";
            $data['cont_data'] .= "\t\treturn view('".$menu['view']."');\n";
            $data['cont_data'] .= "\t}\n";
            $data['cont_data'] .= "}";
            file_put_contents($data['controller'],$data['cont_data']);

            // Add Blade File
            $data['view'] = array_reverse(explode('.', $menu['view']));
            unset($data['view'][0]);
            $blade_path = '';
            foreach ($data['view'] as $key => $value) {
                $blade_path .= '\\' . $value;
            }
            $data['blade_path'] = base_path() . '\resources\views' . $blade_path;
            if (!is_dir($data['blade_path'] ) || !file_exists($data['blade_path'] ))
            mkdir($data['blade_path'] , 0777, true);
            $file_path = $data['blade_path'] . '\\'. array_reverse(explode('.', $menu['view']))[0] . '.blade.php';
            $data['file_path'] = $file_path;
            $fh = fopen($file_path, 'w') or die("Can't create file");
            $blade_content = "@extends('Admin.admin-file')\n\n";
            $blade_content .= "@section('admin-section')\n\n";
            $blade_content .= "@endsection";
            file_put_contents($file_path,$blade_content);

            if (DB::table('admin_menu')->insert($menu)) {
                return redirect()->route('admin.menu')->with(['responce' => 'Menu SuccessFully Added', 'alert_type' => 'primary']);
            } else {
                return redirect()->route('admin.add_menu')->with(['responce' => 'Menu SuccessFully Added', 'alert_type' => 'danger']);
            }
        } else {
            $validated = $request->validate([
                'menu_name' => 'required|unique:admin_menu,name,' . $id,
                'menu_icon' => 'required',
                'menu_controller' => 'required',
                'view_file' => 'required',
                'menu_route'  => 'required|unique:admin_menu,route,' . $id,
                'menu_route_name'  => 'required|unique:admin_menu,route_name,' . $id,
            ]);
            $menu = array(
                'name' => $request->post('menu_name'),
                'icon' => $request->post('menu_icon'),
                'controller' => $request->post('menu_controller'),
                'status' => $request->post('status'),
                'view' => $request->post('view_file'),
                'route'  => $request->post('menu_route'),
            );
            if (DB::table('admin_menu')->where('id', $id)->update($menu)) {
                return redirect()->route('admin.menu')->with(['responce' => 'Menu SuccessFully Updated', 'alert_type' => 'primary']);
            } else {
                return redirect()->route('admin.add_menu')->with(['responce' => 'Error While Updating Menu', 'alert_type' => 'danger']);
            }
        }
    }
    public function view_menu($id, Request $request)
    {
        $menu = Menu::select('id', 'name', 'icon', 'controller', 'status', 'view', 'route','route_name','group')->where('id', $id)->get()->toArray();
        $data['menu'] = $menu[0];
        return view('Admin.view_menu', $data);
    }
    public function delete_menu($id, Request $request)
    {
        $data = [
            'responce' => '',
            'alert_type' => '',
        ];
        if (DB::table('admin_menu')->where('id', $id)->delete()) {
            $data = [
                'responce' => 'Menu Deleted Succesfully.',
                'alert_type' => 'primary',
            ];
        } else {
            $data = [
                'responce' => 'Error In Delete Menu',
                'alert_type' => 'danger',
            ];
        }
        return redirect()->route('admin.menu')->with($data);
    }
}
