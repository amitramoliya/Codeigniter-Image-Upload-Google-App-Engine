<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
   use google\appengine\api\cloud_storage\CloudStorageTools;


class Mygae {

	var $CI;
	public $bucket_name	= '';


    public function __construct($props = array())
    {
    	
        $this->CI =& get_instance();
        if (count($props) > 0)
		{

			$this->bucket_name = $props['name'];

		}
        
    }

    // public function test(){
    // 	return $this->bucket_name;
    // }

    public function get_gae_default_bucket_name(){

    	 return CloudStorageTools::getDefaultGoogleStorageBucketName();
    	
    }

    public function get_gae_bucket_folder_path($path=''){

    	if(isset($path) && $path!=''){
    		return 'gs://'.$this->bucket_name.'/'.$path;
    	}else{
    		return 'gs://'.$this->bucket_name.'/';
    	}
    	
    }

     public function get_gae_file_upload_url($upload_path_url){

    	$options = [ 'gs_bucket_name' => $this->bucket_name ];
 		$upload_url = CloudStorageTools::createUploadUrl('/'.$upload_path_url, $options);
    	return $upload_url;
    }


     public function get_gae_file_view_url($file_name){

    	$object_image_file = 'gs://'.$this->bucket_name.'/'.$file_name;
		$object_image_url = CloudStorageTools::getImageServingUrl($object_image_file,
	                                            ['size' => 0, 'crop' => false]);
		return $object_image_url;
    }
}

?>