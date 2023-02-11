<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Production asset bundle for the Filepond plugin image preview.
 */
final class PluginImagePreviewProdAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond-plugin-image-preview/dist';
    public array $css = ['filepond-plugin-image-preview.min.css'];
    public array $js = ['filepond-plugin-image-preview.min.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**filepond-plugin-image-preview.min.css',
                '**filepond-plugin-image-preview.min.js',
            ),
        ];
    }
}
