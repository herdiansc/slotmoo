<?php 
class SitemapsController extends AppController{ 

    var $name = 'Sitemaps'; 
    var $uses = array('Listing'); 
    var $helpers = array('Time'); 
    var $components = array('RequestHandler'); 
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('index');
    }

    function index() {     
        $this->set('listings', $this->Listing->find('all', array('order'=>'Listing.created DESC','limit'=>20)));
        //debug logs will destroy xml format, make sure were not in drbug mode 
        Configure::write ('debug', 0); 
    } 
} 
?>
