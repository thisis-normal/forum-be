<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Post;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageService
{
    public function saveImages($images, $model): void
    {
        // Chắc chắn rằng $images là một mảng để xử lý đồng nhất
        $images = is_array($images) ? $images : [$images];
        foreach ($images as $image) {
            $this->saveImage($image, $model);
        }
    }

    public function saveImage($image, $model): void
    {
        // Thay đổi tên file ảnh để làm cho nó duy nhất
        $imageName = time().'.'.$image->extension();
        $relativePath = 'images/post/'.$imageName;
        // Store làm nhiệm vụ lưu trữ file ảnh trong thư mục storage
        $image->storeAs('public/images/post', $imageName);
        // Sau khi lưu ảnh, lưu thông tin ảnh vào bảng 'images'
        $newImage = new Image();
        $newImage->path = $relativePath;
        $newImage->save();
        // Khi đã có bản ghi image, ta liên kết nó với đối tượng imageable thông qua Polymorphic Relation
        $model->images()->save($newImage);
    }

    public function removePathString($model): array
    {
        $modelArray = $model->toArray();
        foreach ($modelArray['images'] as &$image) {
            unset($image['path']);
        }
        return $modelArray;
    }
}
