<?php
/**
 * Created by PhpStorm.
 * User: Dima
 * Date: 06.03.2016
 * Time: 16:23
 */

namespace components;

use Yii;
use yii\base\Component;
use exceptions\FileException;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;
use interfaces\FileModelInterface;
use exceptions\FileUploadException;

class FileService extends Component
{
    public $filePath = 'files';
    public $removeOldFile = true;

    /**
     * @param FileModelInterface $model
     * @return bool
     */
    public function loadFile($model)
    {
        $file = UploadedFile::getInstance($model->getModelInstance(), $model->getFileAttributeName());
        if ($file === null) {
            return true;
        }

        // Create path for uploading file
        list($path, $url) = $this->createPath($file->name);

        $cropInfo = $model->getCropInfo();
        if (!empty($cropInfo)) {
            Image::$driver = Image::DRIVER_GD2;

            $width = $model->getImgWidth();
            $height = $model->getImgHeight();
            $newWidth = isset($cropInfo['dWidth']) ? (int)$cropInfo['dWidth'] : $model->getImgWidth();
            $newHeight = isset($cropInfo['dHeight']) ? (int)$cropInfo['dHeight'] : $model->getImgHeight();
            $x = isset($cropInfo['x']) ? $cropInfo['x'] : 0;
            $y = isset($cropInfo['y']) ? $cropInfo['y'] : 0;

            $newSizeThumb = new Box($newWidth, $newHeight);
            $cropSizeThumb = new Box($width, $height);
            $cropPointThumb = new Point($x, $y);

            $image = Image::getImagine()->open($file->tempName);

            // Resize and crop the image
            $result = $image
                ->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($path, ['quality' => 100]);

            if (!$result) {
                return false;
            }
        } else {
            // Save the file
            if (!$file->saveAs($path)) {
                return false;
            }
        }

        if ($this->removeOldFile && $model->getOldFileName()) {
            $oldFile = Yii::getAlias('@webroot' . $model->getOldFileName());
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $model->setFileName($url);

        return true;
    }

    /**
     * @param string $path
     * @param array|string $content
     * @return bool
     * @throws FileException
     */
    public function createFile($path, $content = [])
    {
        if (!file_put_contents($path, $content)) {
            throw new FileException($this->t('Не удалось создать файл {path}', ['path' => $path]));
        }

        return true;
    }

    protected function createPath($file)
    {
        $path = Yii::getAlias('@webroot/' . $this->filePath);
        $date = new \DateTime();
        $dateString = $date->format('Y/m/d');
        $fullPath = $path . '/' . $dateString;

        if (!is_dir($fullPath)) {
            $path .= '/' . $date->format('Y');
            $this->mkDir($path);

            $path .= '/' . $date->format('m');
            $this->mkDir($path);

            $path .= '/' . $date->format('d');
            $this->mkDir($path);
        }

        $file = Yii::$app->security->generateRandomString() . '_' . $file;

        return [str_replace(DIRECTORY_SEPARATOR, '/', $fullPath . '/' . $file), '/' . $this->filePath . '/' . $dateString . '/' . $file];
    }

    private function mkDir($path)
    {
        if (!is_dir($path) && !mkdir($path, 0755, true)) {
            throw new FileUploadException($this->t('Не удалось создать директорию {dirName}', ['dirName' => $path]));
        }
    }
}