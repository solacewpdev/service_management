<?php
namespace Service_Management\Classes;

class File_Cleanup
{
    public $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function init()
    {
        add_action('init', array( $this, 'file_cleanup' ) );
    }

    public function file_cleanup()
    {
        // Folder path to be flushed 
        $folder_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/uploads/service_management'; 
        
        // List of name of files inside 
        // specified folder 
        $files = glob($folder_path.'/*.pdf');  
        
        // Deleting all the files in the list 
        foreach($files as $file) { 
        
            if(is_file($file))  
            
                // Delete the given file 
                unlink($file); 

        }
    }
}