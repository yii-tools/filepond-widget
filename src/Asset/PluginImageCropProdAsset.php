<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Production asset bundle for the Filepond plugin image preview.
 */
final class PluginImageCropProdAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond-plugin-image-crop';
    public array $js = ['dist/filepond-plugin-image-crop.min.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only('**filepond-plugin-image-crop.min.js'),
        ];
    }
}
