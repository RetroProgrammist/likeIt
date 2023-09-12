<?php

namespace Rzhanau\Main\Helper;

class FileManager
{
    public const IMAGE_DIR = '/reviews/images/';
    private string $rootPath;

    public function __construct()
    {
        $this->rootPath = __DIR__ . '/../../';
    }

    public function getFiles(string $path): array
    {
        $arFile = [];
        $fileDir = preg_replace('|([/]+)|s', '/', $this->rootPath . $path);
        $files = scandir($fileDir);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            $filePath = $path . $file;
            $arFile[] = sprintf('<br /><a href="%s">%s</a>', $filePath, $file);
        }

        return $arFile;
    }

    public function getRootUserFilePath(string $userEmail, string $userName): string
    {
        return self::IMAGE_DIR . md5($userEmail . $userName) . '/';
    }

    public function uploadFiles(string $path): void
    {
        $fileDir = preg_replace('|([\/]+)|s', '/', $this->rootPath . $path);
        if (!is_dir($fileDir) && !mkdir($fileDir) && !is_dir($fileDir)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $fileDir));
        }

        for ($i = 0, $iMax = count($_FILES["images"]["name"]); $i < $iMax; $i++) {
            move_uploaded_file(
                $_FILES["images"]["tmp_name"][$i],
                $fileDir . $_FILES["images"]["name"][$i]
            );
        }
    }
}