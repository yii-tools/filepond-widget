## Plugin image exif orientation

Retrieves the EXIF orientation data from JPEG images. This helps in correctly orienting photos taken on mobile devices.

The Image preview plugin uses this information to show the correct preview. The Image transform plugin uses this information to transform the image before uploading it to the server.

### methods of the plugin

Method                        | Parameter | Description                                                        | Default
------------------------------|-----------|--------------------------------------------------------------------|---------
`allowImageExifOrientation()` | `bool`    | Return new instance with enable or disable image exif orientation. | `true`
