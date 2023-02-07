<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Asset bundle for the Filepond plugin image exif orientation.
 */
final class PluginImageExifOrientationCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = [
        'https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js',
    ];
}
