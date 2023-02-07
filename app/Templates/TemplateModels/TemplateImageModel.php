<?php

namespace App\Templates\TemplateModels;

use App\Libraries\ImageProxy;
use Illuminate\Database\Eloquent\Model;

abstract class TemplateImageModel extends Model
{
    public const DESKTOP = '';
    public const TABLET = 't_';
    public const LARGE_MOBILE = 'lm_';
    public const MOBILE = 'm_';

    public const ARRAY_DEVICE = [self::DESKTOP, self::TABLET, self::LARGE_MOBILE, self::MOBILE];

    public const BASE_FIELD_NAME = 'file_name';

    protected $dir;
    protected $path;

    public function getDir()
    {
        return config(
            'image.' . class_basename($this),
            config('image.DefaultImage')
        );
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->dir = $this->getDir();
        $this->path = storage_path('/app/public/img/' . $this->dir . '/');
    }

    public function delete()
    {
        foreach (self::ARRAY_DEVICE as $prefix) {
            if (!empty($this->{$prefix . self::BASE_FIELD_NAME})
                && is_file($this->path . $this->{$prefix . self::BASE_FIELD_NAME})
            ) {
                unlink($this->path . $this->{$prefix . self::BASE_FIELD_NAME});
            }
        }

        return parent::delete();
    }

    public function getPath(array $options = [], $extension = 'webp', $type = self::DESKTOP)
    {
        if (!empty($this->{$type . self::BASE_FIELD_NAME})
            && file_exists($this->path . $this->{$type . self::BASE_FIELD_NAME})
        ) {
            $fileName = $this->{$type . self::BASE_FIELD_NAME};
        }

        try {
            if (empty($fileName)) {
                $fileName = config('image.no_img', 'no-img.png');
                $imagePath = "/{$fileName}";
            } else {
                $imagePath = $this->dir . '/' . $fileName;
            }
            $path = ImageProxy::getHref($imagePath, $options, $extension);
        } catch (\Exception $exception) {
            $path = '/public/img/' . config('image.no_img', 'no-img.png');
        }

        return $path;
    }

    public function hasFile($type = self::DESKTOP)
    {
        if (!empty($this->{$type . self::BASE_FIELD_NAME})
            && file_exists($this->path . $this->{$type . self::BASE_FIELD_NAME})
        ) {
            return true;
        }
        return false;
    }
}
