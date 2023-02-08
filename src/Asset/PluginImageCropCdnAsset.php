<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;

/**
 * Content delivery network asset bundle for the Filepond plugin image preview.
 */
final class PluginImageCropCdnAsset extends AssetBundle
{
    public bool $cdn = true;
    public array $js = ['https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.min.js'];
}
