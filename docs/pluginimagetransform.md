## Plugin image transform

The Image transform plugin applies the image modifications supplied by the Image crop and Image resize plugins before the image is uploaded. It can also change the file format to either JPEG or PNG.

### methods of the plugin

Method                                    | Parameter | Description                                                                 | Default
------------------------------------------|-----------|-----------------------------------------------------------------------------|---------
`allowImageTransform()`                   | `bool`    | Return new instance with image transform after create blob. A hook to make changes to the file after the file has been created. | `true`
`imageTransformAfterCreateBlob()`         | `array`   | Return new instance with image transform after create blob. A hook to make changes to the file after the file has been created. | `null`
`imageTransformBeforeCreateBlob()`        | `array`   | Return new instance with image transform before create blob. A hook to make changes to the canvas before the file is created. | `null`
`imageTransformCanvasMemoryLimit()`       | `int`     | Return new instance with image transform canvas memory limit.               | `'isBrowser && isIOS ? 4096 * 4096 : null'`
`imageTransformClientTransforms()`        | `array`   | Return new instance with image transform client transform.                  | `null`
`imageTransformOutputQuality()`           | `int`     | Return new instance with image transform output quality.                    | `null`
`imageTransformOutputQualityMode()`       | `string`  | Return new instance with image transform output quality mode. Should output quality be enforced, set the 'optional' to only apply when a transform is required due to other requirements (e.g. resize or crop). | `'always'`
`imageTransformOutputStripImageHead()`    | `bool`    | Return new instance with image transform output strip image head.           | `true`
`imageTransformVariants()`                | `array`   | Return new instance with image transform variants.                          | `null`
`imageTransformVariantsDefaultName()`     | `string`  | Return new instance with image transform variants default name.             | `null`
`imageTransformVariantsIncludeDefault()`  | `bool`    | Return new instance with image transform variants include default.          | `true`
`imageTransformVariantsIncludeOriginal()` | `bool`    | Return new instance with image transform variants include original.         | `false`