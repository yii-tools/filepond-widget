<?php

declare(strict_types=1);

namespace Yii\FilePond\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Development asset bundle for the Filepond file upload widget.
 */
final class FilePondDevAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond/dist';
    public array $css = ['filepond.css'];
    public array $js = ['filepond.js'];
    public array $depends = [
        PluginFileEncodeDevAsset::class,
        PluginFileValidateSizeDevAsset::class,
        PluginFileValidateTypeDevAsset::class,
        PluginImageExifOrientationDevAsset::class,
        PluginImagePreviewDevAsset::class,
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only('**filepond.css', '**filepond.js'),
        ];
    }
}
