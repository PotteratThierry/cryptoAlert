<?php
interface iDatabase
{
    public function getInstanceParam($host, $port) ;
    public function getInstance();
    public function save(requestBuilder $param) ;
    public function update(requestBuilder $param) ;
    public function load(requestBuilder $param) ;
    public function loadOnce(requestBuilder $param) ;
    public function delete(requestBuilder $param) ;
    public function deleteALL() ;
    public function getResult();
}
