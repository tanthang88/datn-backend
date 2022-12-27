<?php

namespace App\Helper;
use Illuminate\Support\Str;

class Category_Product_Helper
{
    public static function  category($product_categories,$parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($product_categories as $key => $category){
            if($category->parent_id == $parent_id){
                $html .= '
                <tr>
                    <td>'. $category->id .'</td>
                    <td>';
                    if ($category->category_image!=null)
                        $html .='<img style="width:80px;height:80px;object-fit: cover;" src="' .$category->category_image.'">';
                    else
                        $html .='Trống';
                    $html .='
                    <td>
                        <a>
                            ' . $char . $category->category_name  . '
                        </a>
                    </td>
                    <td>';
                    if($category->category_display ==1)
                        $html .='<span class="badge badge-success">Hiển thị</span>';
                    else
                        $html .='<span class="badge badge-danger">Ẩn</span>';
                    $html .='</td>
                    <td style="text-align:center;">';
                    if($category->category_outstanding ==1)
                        $html.='<i class="fa fa-star" aria-hidden="true"></i>';
                    $html .=
                    '</td>
                    <td class="project-actions">
                        <a class="btn btn-sm btn-info" href="'.route('categoryProduct.update',['id'=>$category->id]) .'">
                            <i class="fas fa-pencil-alt"></i>Sửa
                        </a>
                        <a class="btn btn-sm btn-danger btn-action-delete"
                            data-url="/categoriesProduct/delete/' . $category->id . '">
                            <i class="fas fa-trash">
                            </i>
                            Xóa
                        </a>
                    </td>
                </tr>
                ';
                $html .= self::category($product_categories, $category->id, $char . '--');
            }
        }

        return $html;
    }
}
