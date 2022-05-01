<?php

use Illuminate\Support\Facades\DB;

function prx($arr)
{

    dd($arr);
    die;
}

function getTopNavCat()
{
    $result = DB::table('categories')
        ->where(['status' => 1])
        ->get();
    $arr = [];
    foreach ($result as $row) {
        $arr[$row->id]['category_name'] = $row->category_name;
        $arr[$row->id]['parent_id'] = $row->parent_id;
        $arr[$row->id]['category_slug'] = $row->category_slug;
    }
    // prx($arr);
    $str = buildTreeView($arr, 0);
    return $str;
}
$html = '';
function buildTreeView($arr, $parent, $level = 0, $prelevel = -1)
{
    global $html;
    foreach ($arr as $id => $data) {
        if ($parent == $data['parent_id']) {
            if ($level > $prelevel) {
                if ($html == '') {
                    $html .= '<ul class="nav navbar-nav">';
                } else {
                    $html .= '<ul class="dropdown-menu">';
                }
            }
            if ($level == $prelevel) {
                $html .= '</li>';
            }
            $html .= '<li><a href="/category/' . $data['category_slug'] . '">' . $data['category_name'] . '<span class="caret"></span></a>';
            if ($level > $prelevel) {
                $prelevel = $level;
            }
            $level++;
            buildTreeView($arr, $id, $level, $prelevel);
            $level--;
        }
    }
    if ($level == $prelevel) {
        $html .= '</li></ul>';
    }
    return $html;
}

function get_user_temp_id()
{
    if (session()->has('user_temp_id') == null) {
        $rand = rand(1111111111, 9999999999);
        session()->put('user_temp_id', $rand);
        return $rand;
    } else {
        return session()->get('user_temp_id');
    }
}

function get_cart_items_count()
{
    if (session()->has('reg_user')) {
        $user_id = session()->get('reg_user');
        $user_type = "reg";
    } else {
        $user_id = get_user_temp_id();
        $user_type = "non-reg";
    }
    $result = DB::table('carts')
        ->where('user_id', $user_id)
        ->where('user_type', $user_type)
        ->get();
    return count($result);
}

function get_guest_cart_items()
{
    if (session()->has('guest_user_id')) {
        $user_id = session()->get('guest_user_id');
        $user_type = "guest";
    } else {
        $user_id = get_user_temp_id();
        $user_type = "guest";
    }
    $result = DB::table('carts')
        ->select('carts.*', 'products.qty as stock', 'products.id', 'products.name', 'products.type', 'products.price', 'products.desc', 'products.SKU', 'products.main_image', 'products.images', 'products.status')
        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
        ->where('user_id', $user_id)
        ->where('user_type', $user_type)
        ->get();
    // var_dump($result);die;
    return $result;
}

function get_user_cart_items($id)
{
    $result = DB::table('carts')
        ->select('carts.*', 'products.qty as stock', 'products.id', 'products.name', 'products.type', 'products.price', 'products.desc', 'products.SKU', 'products.main_image', 'products.images', 'products.status')
        ->leftJoin('products', 'products.id', '=', 'carts.product_id')
        ->where('user_id', $id)
        ->where('user_type', 'user')
        ->get();
    return $result;
}
