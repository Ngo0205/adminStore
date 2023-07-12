<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

//model được tạo ra kèm với bảng db với tên tương ứng. nếu không cùng tên mà muốn dùng bảng db nào đó,
// ta khai báo trong model : protected $table = 'name_table'

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    // khai baáo dưới có nghĩa là tất cả các key trong mảng $fillable phải được truyền đủ,
    // key là cái feild của talbe trong db được tạo. nếu tất cả cái feild đều requited thì có thể khai báo
    //protected $guarded = [];

    protected $fillable = ['name', 'price', 'content', 'user_id', 'category_id', 'feature_image', 'feature_image_name'];



    //sử dụng Eloquent: Relationships để kết nối giữa các bảng.đọc thêm tại:
    // https://laravel.com/docs/10.x/eloquent-relationships
    // hàm dùng để lấy các tags của sản phẩm với mối quan hệ n-1, sử dụng BelongsToMany cũng tương tự beLongTo
    public function tags(): BelongsToMany
    {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')
            ->withTimestamps();
    }

    // dùng để lấy các sản phẩm có cùng danh mục, mối quan hệ n-1
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // dùng để lấy các ảnh chi tiết cuar sản phẩm thuộc một sản phầm, mqh 1-n, sử dụng hàm hasMany
     public function productImageDetail(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }


}
