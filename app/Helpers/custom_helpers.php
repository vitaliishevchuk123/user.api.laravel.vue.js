<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;


if (!function_exists('get_locale')) {
    function get_locale(): string
    {
        return App::getLocale();
    }
}

if (!function_exists('set_locale')) {
    function set_locale(string $lang): void
    {
        if (in_array($lang, config('app.langs', []), true)) {
            App::setLocale($lang);
        }
    }
}

if (!function_exists('clear_phone')) {
    function clear_phone($phone)
    {
        if (!empty($phone)) {
            return str_replace([' ', '-', '(', ')'], '', $phone);
        }

        return '';
    }
}

if (!function_exists('formatted_phone')) {
    function formatted_phone($phone)
    {
        if (!empty($phone)) {
            return str_replace('-', ' ', $phone);
        }

        return '';
    }
}

if (! function_exists('is_main')) {
    function is_main(): bool
    {
        return Route::currentRouteName() === 'home';
    }
}

if (! function_exists('get_main_page_url')) {
    function get_main_page_url(bool $checkCurrentUrl = false): string
    {
        if ($checkCurrentUrl && is_main()) {
            return 'javascript:void(0);';
        }
        $locale = app()->getLocale();
        return $locale === route('home');
    }
}

if (!function_exists('add_query_params')) {
    function add_query_params(array $params = [], $page = null): string
    {
        $url = url()->current();
        if ($page && $num = request('num')) {
            $url = str_replace("/{$num}/", "/{$page}/", $url);
        }

        $query = array_merge(
            request()->query(),
            $params
        );

        return $url . '?' . http_build_query($query);
    }
}

if (!function_exists('remove_query_params')) {
    function remove_query_params(array $params = [], $page = null): string
    {
        $url = url()->current();
        if ($page && $num = request('num')) {
            $url = str_replace("/{$num}/", "/{$page}/", "$url");
        }
        $query = request()->query();

        foreach ($params as $param) {
            unset($query[$param]);
        }

        return $query ? $url . '?' . http_build_query($query) : $url;
    }
}

if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($text): string
    {
        if (empty($text)) {
            return '';
        }
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }
}

if (!function_exists('current_route_name')) {
    function current_route_name(): ?string
    {
        return Route::currentRouteName();
    }
}
