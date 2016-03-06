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

        // Save the file
        if (!$file->saveAs($path)) {
            return false;
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