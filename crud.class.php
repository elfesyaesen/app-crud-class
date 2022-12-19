<?php 
    class PhpYardimlasmaGrubu
    {
        /* VERİTABANI BAĞLANTISI İÇİN GEREKLİ PARAMETRELER TANIMLANDI.. */
        protected $db = null;
        protected $host = 'localhost';
        protected $user = 'root';
        protected $pass = '';
        protected $dbname   = 'crud';
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
        /* VERİTABANINDAN TOPLU , KOŞULSUZ VERİ ALMAK */
        public function pdoMultipleSelect(string $sql){
            $query = $this->pdo->query($sql);
            $response = $query->fetchAll(PDO::FETCH_OBJ);
            if($response) return $response; else return false;
        }
        /* VERİTABANINDAN TOPLU , KOŞULLU VERİ ALMAK */
        public function pdoSelect(string $sql,array $params){
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute($params);
            $response = $prepare->fetchAll(PDO::FETCH_OBJ);
            if($response) return $response; else return false;
        }
        /* TEKİL VERİ ALMAK */
        public function pdoSingleSelect(string $sql,array $params){
            $prepare = $this->pdo->prepare($sql);
            $prepare->execute($params);
            $response = $prepare->fetch(PDO::FETCH_OBJ);
            if($response) return $response; else return false;
        }



    }