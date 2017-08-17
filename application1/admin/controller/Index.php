<?php

namespace app\admin\controller;

class Index extends Base
{
    //
 public  function index(){

     return $this->fetch();

 }

    /**
     * @return mixed
     */
    public function webSite()
    {

          $config = [
            'url'               => $_SERVER['HTTP_HOST'],
            'document_root'     => $_SERVER['DOCUMENT_ROOT'],
            'server_os'         => PHP_OS,
            'server_port'       => $_SERVER['SERVER_PORT'],
            'server_soft'       => $_SERVER['SERVER_SOFTWARE'],
            'php_version'       => PHP_VERSION,
              'version'  =>version,
            'max_upload_size'   => ini_get('upload_max_filesize')
        ];
        return $this->fetch('config', ['config' => $config]);
    }



}
