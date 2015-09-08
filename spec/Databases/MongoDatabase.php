<?php namespace BackupManager\Databases;

/**
 * Class MysqlDatabase
 * @package BackupManager\Databases
 */
class MongoDatabase implements Database {

    /** @var array */
    private $config;

    /**
     * @param $type
     * @return bool
     */
    public function handles($type) {
        return strtolower($type) == 'mongodb';
    }

    /**
     * @param array $config
     * @return null
     */
    public function setConfig(array $config) {
        $this->config = $config;
    }

    /**
     * @param $outputPath
     * @return string
     */
    public function getDumpCommandLine($outputPath) {
        return sprintf('mongodump -h %s:%s -u %s -p %s -d %s -o %s',
            escapeshellarg($this->config['host']),
            escapeshellarg($this->config['port']),
            escapeshellarg($this->config['user']),
            escapeshellarg($this->config['pass']),
            escapeshellarg($this->config['database']),
            escapeshellarg($outputPath)
        );
    }

    /**
     * @param $inputPath
     * @return string
     */
    public function getRestoreCommandLine($inputPath) {
        return sprintf('mongorestore -h %s:%s -u %s -p %s -d %s -o %s',
            escapeshellarg($this->config['host']),
            escapeshellarg($this->config['port']),
            escapeshellarg($this->config['user']),
            escapeshellarg($this->config['pass']),
            escapeshellarg($this->config['database']),
            $inputPath
        );
    }
}