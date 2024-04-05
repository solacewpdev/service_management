<?php 
namespace Service_Management\Classes;
interface Interface_CRUD_Objects
{    
    /**
     * create_object
     *
     * @return void
     */
    public function create_object();
    
    /**
     * read_object
     *
     * @return void
     */
    public function read_object();
    
    /**
     * update_object
     *
     * @return void
     */
    public function update_object();
    
    /**
     * delete_object
     *
     * @return void
     */
    public function delete_object();

}