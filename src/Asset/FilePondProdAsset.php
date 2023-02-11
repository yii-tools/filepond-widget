<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Production asset bundle for the Filepond file upload widget.
 */
final class FilePondProdAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond';
    public array $css = ['dist/filepond.min.css'];
    public array $js = ['dist/filepond.min.js'];
    public array $depends = [
        PluginFileEncodeProdAsset::class,
        PluginFileValidateSizeProdAsset::class,
        PluginFileValidateTypeProdAsset::class,
        PluginImageExifOrientationProdAsset::class,
        PluginImagePreviewProdAsset::class,
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only('**filepond.min.css', '**filepond.min.js'),
        ];
    }
}
