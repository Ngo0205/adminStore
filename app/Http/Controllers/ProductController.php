<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Trait\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PharIo\Version\Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $products;
    private $category;
    private $productImage;
    private $tags;
    private $productTag;
    use StorageImageTrait;

    public function __construct(Product $product, Category $category, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->products = $product;
        $this->productImage = $productImage;
        $this->tags = $tag;
        $this->productTag = $productTag;
    }

    //function lấy các danh mục, dùng đệ quy được khai báo trong Recusive
    public function getCategory($parentId)
    {

        $data = $this->category->all(); // tương tự với $data =  SELECT * FROM products;
        $recusive = new Recusive($data);
        $htmlOption = $recusive->category($parentId);
        return $htmlOption;
    }

    //tạo màn hình chính cho product
    public function index()
    {
        //tạo phân trang cho DS sản phẩm lấy ra. dùng paginate để lấy số lượng sản phẩm trên một trang
        //truyền sang view dùng hàm link() để tạo phân trang.
        $product = $this->products->latest()->paginate(7);
        return view('admin.product.index', compact('product'));
    }


    //hàm trả về view thêm sản phẩm
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    // Hàm thêm san phẩm vào database
    public function store(ProductRequest $request)
    {
        try {
            DB::beginTransaction();
            $dataUploadProduct = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUpLoadImageMain = $this->storageTraitUpLoad($request, 'feature_image', 'product');
            if (!empty($dataUpLoadImageMain)) {
                $dataUploadProduct ['feature_image'] = $dataUpLoadImageMain['file_path'];
                $dataUploadProduct ['feature_image_name'] = $dataUpLoadImageMain['file_name'];
            }
            $productInstance = $this->products->create($dataUploadProduct);
            //tương tự với INSERT INTO 'categories'

            //insert data to product_image
            if ($request->hasFile('image')) {
                foreach ($request->image as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUpLoadImageDetail($fileItem, 'product');
                    $productInstance->productImageDetail()->create([
                        'image' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags to product
            if (!empty($request->tag)) {
                foreach ($request->tag as $tagItem) {
                    //insert tags to table tags
                    $tagInstance = $this->tags->firstOrCreate(
                        ['name' => $tagItem]
                    );
                    //insert tag to productTag
                    $tagId[] = $tagInstance->id;
                }
            }
            $productInstance->tags()->attach($tagId);
            DB::commit();

        } catch (Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
        }
        return redirect(route('products.index'));
    }

    //function edit sản phẩm
    public function edit($id)
    {
        $products = $this->products->find($id); // tương tự với $product = SELECT * FROM products WHERE id = $id;

        $htmlOption = $this->getCategory($products->category_id);
        return view('admin.product.edit', compact('htmlOption', 'products'));
    }

    //function update sản phẩm vào database sau khi edit
    public function update($id, Request $request)
    {

        try {
            DB::beginTransaction();
            $dataUploadProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUpLoadImageMain = $this->storageTraitUpLoad($request, 'feature_image', 'product');
            if (!empty($dataUpLoadImageMain)) {
                $dataUploadProductUpdate ['feature_image'] = $dataUpLoadImageMain['file_path'];
                $dataUploadProductUpdate ['feature_image_name'] = $dataUpLoadImageMain['file_name'];
            }
            $this->products->find($id)->update($dataUploadProductUpdate);
            $productInstance = $this->products->find($id);

            //insert data to product_image
            if ($request->hasFile('image')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUpLoadImageDetail($fileItem, 'product');
                    $productInstance->productImageDetail()->create([
                        'image' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags to product
            if (!empty($request->tag)) {
                foreach ($request->tag as $tagItem) {
                    //insert tags to table tags
                    $tagInstance = $this->tags->firstOrCreate(
                        ['name' => $tagItem]
                    );
                    //insert tag to productTag
                    $tagId[] = $tagInstance->id;
                }
            }
            $productInstance->tags()->sync($tagId);
            DB::commit();

        } catch (Exception $exception) {
            DB::rollback();
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
        }
        return redirect(route('products.index'));
    }

    // function xoá sản phẩm, ở đây sử dụng soft delete.
    //Cách hoạt động của soft delete là laravel sẽ thêm cột delete_at trên bảng
    // và mặc định giá trị của cột delete_at sẽ là null.
    //Khi chúng ta xóa một bản ghi trong database
    // thì giá trị của cột delete_at ở bản ghi bị xóa sẽ được cập nhật bằng thời gian hiện tại
    // và khi query lấy dữ liệu thì Model Laravel luôn thêm điều kiện delete_at = null vào câu query.
    public function delete($id)
    {
        try {
            $this->products->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '. Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
