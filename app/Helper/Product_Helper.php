<?php

namespace App\Helper;
use Illuminate\Support\Str;

class Product_Helper
{
    public static function  product_category($categories,$parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category){
            if($category->parent_id == $parent_id){
                $html .= '<option value=" '.$category->id.' "> '. $char .$category->category_name.'</option>';
                unset($category[$key]);

                $html .= self::product_category($categories, $category->id, $char . '---');
            }
        }

        return $html;
    }

    public static function  product_category_update($categories,$category_id,$parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category){
            if($category->parent_id == $parent_id){
                $html .= '<option value=" '.$category->id.' " ';
                    if($category->id == $category_id ){
                        $html .= 'selected';
                    }
                $html .=   ' > '.$char .$category->category_name.'</option> ';
                unset($category[$key]);

                $html .= self::product_category_update($categories, $category->id, $char . '---');
            }
        }

        return $html;
    }

}
