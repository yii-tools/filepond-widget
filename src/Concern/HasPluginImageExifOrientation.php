<?php

declare(strict_types=1);

namespace Yii\FilePond\Concern;

/**
 * HasPluginImageExifOrientation provides methods for managing the plugin image exif orientation.
 */
trait HasPluginImageExifOrientation
{
    /**
     * Return new instance with enable or disable image exif orientation.
     *
     * @param bool $value Enable or disable image exif orientation. Default: `true`.
     */
    public function allowImageExifOrientation(bool $value): self
    {
        $new = clone $this;
        $new->options['allowImageExifOrientation'] = $value;

        return $new;
    }
}
