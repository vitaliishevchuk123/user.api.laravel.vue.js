<?php

/*
|--------------------------------------------------------------------------
| ImageProxy
|--------------------------------------------------------------------------
|
| https://docs.imgproxy.net/#/generating_the_url_advanced
|
*/

namespace App\Libraries;

class ImageProxy
{
    private static string $keyBin = '';

    private static string $saltBin = '';

    private static string $signatureSize = '';

    private static string $url = '';

    /**
     * @throws \Exception
     */
    public static function getHref(string $imagePath, array $options = [], ?string $extension = 'webp'): string
    {
        if (! self::$keyBin || ! self::$saltBin) {
            self::setSignatureParams();
        }

        $path = self::getPath($imagePath, $options, $extension);
        $signature = self::getSignature($path);

        return asset('/images/' . $signature . $path);
    }

    private static function getPath(string $imagePath, array $options, ?string $extension): string
    {
        $encodedUrl = self::getEncodedUrl($imagePath);

        return '/' . implode('/', $options) . "/{$encodedUrl}" . ($extension ? ".{$extension}" : '');
    }

    private static function getEncodedUrl(string $imagePath): string
    {
        $encodedUrl = rtrim(strtr(base64_encode(self::$url . $imagePath), '+/', '-_'), '=');

        return substr($encodedUrl, 0, 7) . '/' . substr($encodedUrl, 7);
    }

    private static function getSignature(string $path): string
    {
        $signature = hash_hmac('sha256', self::$saltBin . $path, self::$keyBin, true);
        $signature = pack('A' . self::$signatureSize, $signature);

        return rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');
    }

    /**
     * @throws \Exception
     */
    private static function setSignatureParams(): void
    {
        $key = config('imageproxy.img_proxy_key');
        $salt = config('imageproxy.img_proxy_salt');

        self::$keyBin = pack('H*', $key) ?: '';
        if (! self::$keyBin) {
            throw new \Exception('Key expected to be hex-encoded string');
        }

        self::$saltBin = pack('H*', $salt) ?: '';
        if (! self::$saltBin) {
            throw new \Exception('Salt expected to be hex-encoded string');
        }

        self::$signatureSize = config('imageproxy.img_proxy_signature_size', '');
        if (! self::$signatureSize) {
            throw new \Exception('Empty SIGNATURE_SIZE');
        }

        self::$url = config('imageproxy.img_proxy_url', '');
        if (! self::$url) {
            throw new \Exception('Empty IMG_PROXY_URL');
        }
    }
}
