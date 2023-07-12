<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Trait\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\GlobalState\Exception;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    private $slider;
    use StorageImageTrait;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;


    }

    public function index()
    {

        $sliderData = $this->slider->paginate(3);
        return view('admin.slider.index', compact('sliderData'));

    }

    public function create()
    {
        return view('admin.slider.add');
    }

    public function store(SliderRequest $request)
    {

        try {
            DB::beginTransaction();
            $sliderUpload = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $fileUploadImage = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($fileUploadImage)) {
                $sliderUpload['image_path'] = $fileUploadImage['file_path'];
                $sliderUpload['image_name'] = $fileUploadImage['file_name'];
            }
            $dataUpload = $this->slider->create($sliderUpload);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
        }
        return redirect(route('slider.index'));
    }

    public function edit($id)
    {
        $sliderEdit = $this->slider->find($id);
        return view('admin.slider.edit', compact('sliderEdit'));
    }

    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $sliderUpload = [
                'name' => $request->name,
                'description' => $request->description
            ];
            $fileUploadImage = $this->storageTraitUpload($request, 'image_path', 'slider');
            if (!empty($fileUploadImage)) {
                $sliderUpload['image_path'] = $fileUploadImage['file_path'];
                $sliderUpload['image_name'] = $fileUploadImage['file_name'];
            }
            $this->slider->find($id)->update($sliderUpload);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
        }
        return redirect(route('slider.index'));
    }

    public function delete($id)
    {
        try {
            $this->slider->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ]);
        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ]);
        }
//        return redirect(route('slider.index'));
    }
}
