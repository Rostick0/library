<?

$ALLOWED_IMAGE_TYPES = [
    'image/png',
    'image/jpeg',
    'image/jpg',
    'image/webp'
];

$PATH_UPLOAD = './upload/';

class ImageMyLib
{

    public static function uploadImage($image)
    {
        global $PATH_UPLOAD;

        $name = ImageMyLib::setName($image['type']);
        $path = $PATH_UPLOAD . $name;

        $upload = move_uploaded_file($image['tmp_name'], $path);

        if (!$upload) return NULL;

        return $name;
    }

    private static function setName($type)
    {
        return time() . random_int(1000, 9999) . "." . ImageMyLib::getTypeImg($type);
    }

    private static function getTypeImg($type)
    {
        return array_slice(
            explode('/', $type),
            -1,
            1
        )[0];
    }

    public static function deletePhoto($name)
    {
        global $PATH_UPLOAD;

        if (!$name) return;

        $path = $PATH_UPLOAD . $name;

        if (!file_exists($path)) return;

        return unlink($path);
    }

    public static function updatePhoto($photo_new, $photo_old)
    {
        ImageMyLib::deletePhoto($photo_old);
        return ImageMyLib::uploadImage($photo_new);
    }

    public static function checkTypePhoto($type)
    {
        global $ALLOWED_IMAGE_TYPES;

        return array_search($type, $ALLOWED_IMAGE_TYPES);
    }
}
