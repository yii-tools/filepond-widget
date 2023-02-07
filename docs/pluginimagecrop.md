## Plugin image crop

The Image crop plugin automatically calculates and adds cropping information based on the input image dimensions and the set crop ratio.

The Image preview plugin uses this information to show the correct preview. The Image transform plugin uses this information to transform the image before uploading it to the server.

### methods of the plugin

Method                   | Description                                                                                                   | Default
-------------------------|---------------------------------------------------------------------------------------------------------------|---------
`allowImageCrop()`       | Return new instance with enable or disable image crop.                                                        | `true`
`imageCropAspectRatio()` | Return new instance with the aspect ratio of the crop in human readable format, for example '1:1' or '16:10'. | `null`
