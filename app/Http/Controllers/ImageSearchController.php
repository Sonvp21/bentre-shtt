<?php

namespace App\Http\Controllers;

use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ImageSearchController extends Controller
{
    public function showUploadForm()
    {
        return view('admin.products.image_search.upload');
    }

    public function uploadAndSearch(Request $request)
    {
        // Xác thực ảnh
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        // Xoá các tệp ảnh cũ trong thư mục public/uploads
        $files = Storage::disk('public')->files('uploads');
        Storage::disk('public')->delete($files);
        // Lấy tên gốc của tệp ảnh
        $originalName = $request->file('image')->getClientOriginalName();

        // Lưu ảnh vào public/uploads với tên gốc của tệp
        $path = $request->file('image')->storeAs('uploads', $originalName, 'public');

        Session::put('uploaded_image_path', $path);

        // Nhận diện và tìm kiếm ảnh
        $similarImages = $this->findSimilarImages($path);

        // Sắp xếp mảng $similarImages từ cao đến thấp theo mức độ tương đồng
        usort($similarImages, function ($a, $b) {
            return $b['similarity'] <=> $a['similarity'];
        });

        return view('admin.products.image_search.upload', compact('similarImages'));
    }

    private function findSimilarImages($imagePath)
    {
        // Đọc ảnh đã upload
        $uploadedImage = Image::make(Storage::disk('public')->path($imagePath))->resize(256, 256);

        // Tính histogram của ảnh đã upload
        $uploadedHistogram = $this->calculateHistogram($uploadedImage);

        $similarImages = [];

        // Lấy tất cả các sản phẩm và so sánh ảnh của chúng với ảnh đã upload
        $products = Product::with('media')->get();
        foreach ($products as $product) {
            foreach ($product->getMedia('image_product') as $mediaImage) {
                // Lấy đường dẫn của ảnh từ Laravel Media Library
                $mediaImagePath = $mediaImage->getUrl(); // hoặc $mediaImage->getPath()

                // Tạo đối tượng hình ảnh từ đường dẫn
                $databaseImage = Image::make($mediaImagePath)->resize(256, 256);

                // Tính histogram của ảnh trong cơ sở dữ liệu
                $databaseHistogram = $this->calculateHistogram($databaseImage);

                // So sánh histogram của hai ảnh
                $similarity = $this->compareHistograms($uploadedHistogram, $databaseHistogram);

                // Lưu thông tin vào mảng $similarImages nếu similarity >= 0.5
                if ($similarity >= 0.1) {
                    $similarImages[] = [
                        'image' => $mediaImage,
                        'similarity' => $similarity,
                        'product' => $product,
                    ];
                }
            }
        }

        return $similarImages;
    }

    private function calculateHistogram($image)
    {
        // Tính histogram cho mỗi kênh màu
        $histogram = [];
        $sampleRate = 5; // Lấy mẫu mỗi 5 pixel
        $size = $image->getSize();

        for ($x = 0; $x < $size->width; $x += $sampleRate) {
            for ($y = 0; $y < $size->height; $y += $sampleRate) {
                $pixel = $image->pickColor($x, $y, 'array');
                foreach ($pixel as $channel => $value) {
                    if (!isset($histogram[$channel])) {
                        $histogram[$channel] = array_fill(0, 256, 0);
                    }
                    $histogram[$channel][$value]++;
                }
            }
        }

        // Chuẩn hóa histogram
        foreach ($histogram as &$channel) {
            $maxValue = max($channel);
            if ($maxValue > 0) {
                foreach ($channel as &$bin) {
                    $bin = round(($bin / $maxValue) * 255); // Chuẩn hóa về khoảng 0-255
                }
            }
        }

        return $histogram;
    }


    private function compareHistograms($hist1, $hist2)
    {
        // Tính độ tương đồng của hai histogram bằng công thức chi-square
        $similarity = 0;
        foreach ($hist1 as $channel => $values1) {
            $values2 = $hist2[$channel];
            for ($i = 0; $i < 256; $i++) {
                if ($values1[$i] + $values2[$i] > 0) {
                    $similarity += (pow($values1[$i] - $values2[$i], 2) / ($values1[$i] + $values2[$i]));
                }
            }
        }

        // Tính toán tỷ lệ tương đồng từ 0 đến 1
        $totalChannels = count($hist1);
        $similarity /= $totalChannels * 256; // Chia cho tổng số kênh và giá trị màu

        return 1 - $similarity;
    }
}
