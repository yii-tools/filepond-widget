## Plugin image crop

The Image crop plugin automatically calculates and adds cropping information based on the input image dimensions and the
set crop ratio.

The Image preview plugin uses this information to show the correct preview. The Image transform plugin uses this
information to transform the image before uploading it to the server.

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                   | Parameter | Description                                                                                                   | Default |
|--------------------------|-----------|---------------------------------------------------------------------------------------------------------------|---------|
| `allowImageCrop()`       | `bool`    | Return new instance with enable or disable image crop.                                                        | `true`  |
| `imageCropAspectRatio()` | `string`  | Return new instance with the aspect ratio of the crop in human readable format, for example '1:1' or '16:10'. | `null`  |
