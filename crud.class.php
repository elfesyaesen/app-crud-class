<?php 
    class BestCrudClass
    {
        /* VERİTABANI BAĞLANTISI İÇİN GEREKLİ PARAMETRELER TANIMLANDI.. */
        protected $db = null;
        protected $host = 'localhost';
        protected $user = 'root';
        protected $pass = '';
        protected $dbname   = 'test';
        protected $charset = 'utf8';
        protected $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        /* VERİTABANI BAĞLANTI KURULUMU */
        public function __construct()
        {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            try {
             $this->pdo = new PDO($dsn, $this->user, $this->pass, $this->options);
            } catch (\PDOException $e) {
             throw new \PDOException($e->getMessage(), (int)$e->getCode());
            }
        } 
    }