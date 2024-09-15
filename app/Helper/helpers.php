<?php

use Illuminate\Support\Str;

if (!function_exists('activeMenu')) {
    function activeMenu($uri)
    {
        return Str::startsWith(request()->path(), $uri) ? 'active' : '';
    }
}

if (!function_exists('activeMenuLi')) {
    function activeMenuLi($uri)
    {
        return Str::startsWith(request()->path(), $uri) ? 'mm-active' : '';
    }
}

if (!function_exists('activeTab')) {
    function activeTab($tabName)
    {
        // // Lấy giá trị của tham số 'tab' từ URL hiện tại
        // $currentTab = request()->query('tab');

        // // Nếu không có tham số 'tab' trong URL thì coi như đang ở tab 'all'
        // if (is_null($currentTab) && $tabName === 'all') {
        //     return 'active';
        // }

        // // Nếu giá trị của tham số 'tab' trùng với tên của tab thì đánh dấu là 'active'
        // return $currentTab === $tabName ? 'active' : '';

        // Lấy giá trị của tham số 'tab' từ URL hiện tại
        $currentTab = request()->query('tab', 'all'); // Mặc định là 'all' nếu không có tham số 'tab'

        // So sánh giá trị của tham số 'tab' với tên của tab truyền vào
        return $currentTab === $tabName ? 'active' : '';
    }
}
