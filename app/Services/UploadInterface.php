<?php 
namespace App\Services;


interface UploadInterface {




    /**
     * Upload image
     *
     * @return boolean
     */
    public function image($input, $type) ;
    /**
     * Upload image
     *
     * @return boolean
     */
    public function file($input, $type) ;

    


}
