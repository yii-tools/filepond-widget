## Plugin image preview

The Image Preview plugin renders a downscaled preview for dropped images.

Combined with the Image EXIF orientation plugin it automatically corrects any mobile rotation information to ensure the image is alway shown correctly.

### methods of the plugin

Method                                    | Paramater | Description                                                                 | Default
------------------------------------------|-----------|-----------------------------------------------------------------------------|---------
`allowImagePreview()`                     | `bool`    | Return new instance with enable or disable image preview.                   | `true`
`imagePreviewFilterItem()`                | `string`  | Return new instance with a new image preview filter.                        | `'(fileItem) => true'`
`imagePreviewHeight()`                    | `int`     | Return new instance with a new image preview height.                        | `null`
`imagePreviewMarkupFilter()`              | `string`  | Return new instance with a new image preview markup filter.                 | `'(markupItem) => true'`
`imagePreviewMarkupShow()`                | `bool`    | Return new instance wheater enable or disable image preview markup.         | `true`
`imagePreviewMaxFileSize()`               | `string`  | Return new instance with image preview max file size.                       | `null`
`imagePreviewMaxHeight()`                 | `int`     | Return new instance with image preview max file size.                       | `256`
`imagePreviewMaxInstantPreviewFileSize()` | `string`  | Return new instance with a new image preview max instant preview file size. | `1000000`
`imagePreviewMinHeight()`                 | `int`     | Return new instance with a new image preview min height.                    | `44`
`imagePreviewTransparencyIndicator()`     | `string`  | Return new instance with transparency grid behind the image, set to a color value (for example '#f00') to set transparent image background color. | `null`
