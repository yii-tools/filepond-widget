<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Production asset bundle for the Filepond plugin image transform.
 */
final class PluginPdfPreviewProdAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond-plugin-pdf-preview/dist';
    public array $css = ['filepond-plugin-pdf-preview.min.css'];
    public array $js = ['filepond-plugin-pdf-preview.min.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**filepond-plugin-pdf-preview.min.css',
                '**filepond-plugin-pdf-preview.min.js',
            ),
        ];
    }
}
