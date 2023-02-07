<?php

declare(strict_types=1);

namespace Yii\FilePond\Tests\Provider;

use Yii\FilePond\Asset;

final class CdnAssetProvider
{
    /**
     * @return array array of asset bundles.
     */
    public function assetBundles(): array
    {
        return [
            [
                'Css',
                Asset\FilePondCdnAsset::class,
            ],
            [
                'Css',
                Asset\PluginImagePreviewCdnAsset::class,
            ],
            [
                'Js',
                Asset\FilePondCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileEncodeCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateSizeCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginFileValidateTypeCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageCropCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageExifOrientationCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginImagePreviewCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginImageTransformCdnAsset::class,
            ],
            [
                'Js',
                Asset\PluginPdfPreviewCdnAsset::class,
            ],
        ];
    }
}
