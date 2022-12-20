<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $settings = new Setting;
        $settings = $settings;
        if(isset($request->name)){
            $data['name'] = $request->name;
            $settings = $settings->Where('name', 'like', '%' . $request->name . '%');
        }
        if(isset($request->field_type)){
            $data['field_type'] = $request->field_type;
            $settings = $settings->Where('type', $request->field_type);
        }
        if(isset($request->show_select2) && $request->show_select2 == 1){
            $data['show_select2'] = $request->show_select2;
            $settings = $settings->Where('option', 'like', '%::%');
        }
        foreach ($settings->get() as $id=>$setting){
            if(preg_match('/(?<=::)[^{]+/',$setting->option)){
                $model = str_replace('::','',$setting->option);
                $ext_ = preg_match('/{.*?}/',$setting->option,$ext);
                $model = str_replace($ext[0],'',$model);
                $modelName = '\\App\\Models\\'.$model;
                $model_data = new $modelName;
                $data['models'][$model] = $model_data::pluck('name','id')->toArray();
            }
        }
        $data['settings'] = $settings::paginate(10);
        return view('admin.setting')->with($data);
    }

    public function save($id = '',Request $request)
    {
        $setting = Setting::findOrNew($id);
        if($setting->type == 'file'){
            $set_array = [];
            if($request->file($setting->name) != ''){
                foreach ($request->file($setting->name) as $no => $image) {
                    $extm = $image->getClientOriginalExtension();
                    $_img = $setting['name'] . '-' . $no . '.' . $extm;
                    move_uploaded_file($image, public_path('assets\img\settings\\') . $_img);
                    $set_array[] = $_img;
                }
                $setting->value = json_encode($set_array);
            }else{
                $setting->value =  $request[$setting->name. '_'];
            }
        }else{
            $setting->value = $request[$setting->name];
        }
        if($setting->save()){
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Setting Saved Successfully',
            ];
        }else{
            $data = [
                'show_popup' => 'danger',
                'title'      => 'Error',
                'message'    => 'Error While Saving Setting',
            ];
        }
        \Session()->flash('add_res',$data);
        return redirect()->back();
    }

    public function add_setting(Request $request)
    {
        $validated = $request->validate([
            'new_setting' => 'required|unique:setting,name',
            'field_type' => 'required',
        ]);
        $setting = new Setting;
        $setting->type = $request->field_type;
        $setting->option = $request->options_field;
        $setting->name  = strtolower(str_replace(' ','_',$request->new_setting));
        if($setting->save()){
            $data = [
                'show_popup' => 'primary',
                'title'      => 'Success',
                'message'    => 'Field Added Successfully',
            ];
        }else{
            $data = [
                'show_popup' => 'danger',
                'title'      => 'Failed',
                'message'    => 'Error While Adding Field',
            ];
        }
        \Session()->flash('add_res',$data);
        return redirect()->back();
    }
}
