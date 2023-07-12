<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function index()
    {
        $settingIndex = $this->setting->paginate(3);
        return view('admin.setting.index', compact('settingIndex'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(SettingRequest $request)
    {

        try {
            DB::beginTransaction();
            $dataSetting = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'type' => $request->type
            ];
            $this->setting->create($dataSetting);
            DB::commit();
        } catch (Excption $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '. Line:' . $exception . getLine());
        }
        return redirect(route('setting.index'));
    }

    public function edit($id)
    {
        $dataSettingEdit = $this->setting->find($id);
        return view('admin.setting.edit', compact("dataSettingEdit"));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataSetting = [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value
            ];
            $this->setting->find($id)->update($dataSetting);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '. Line:' . $exception . getLine());
        }
        return redirect(route('setting.index'));
    }

    public function delete($id){

        try {
            $this->setting->find($id)->delete();
            return response()-> json([
                'code' => 200,
                'message'=>'success'
            ],200);
        }catch (Exception $exception){
            Log::error('Message:' . $exception->getMessage() . '. Line:' . $exception . getLine());
            return response()-> json([
                'code' => 500,
                'message'=>'fail'
            ],500);
        }

    }
}
