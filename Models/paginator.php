<?php
class Paginator {
 
    private $_conn;
    private $_limit;
    private $_page;
    private $_query;
    private $_total;
    public function __construct( $conn, $query ) {
     
        $this->_conn = $conn;
        $this->_query = $query;
     
        $rs= $this->_conn->query( $this->_query );
        $this->_total = $rs->num_rows;
         
    }
    public function getData( $limit = '12' ) {
     
        $this->_limit   = $limit;
        $pages = ceil($this->_total / $limit);
        $page = 1;
        $this->_page = $page;
        $too = 0;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        }
    
        if (!$page) {
            $too = 0;
            $page = 1;
        } else {
            $too = ($page - 1) * $limit;
        }
        
        if ( $this->_limit == 'all' ) {
            $query      = $this->_query;
        } else {
            
            $query      = $this->_query . " LIMIT " . ( $too ) . ", $this->_limit";
        }
        $rs             = $this->_conn->query( $query );
     
        while ( $row = $rs->fetch_assoc() ) {
            $results[]  = $row;
        }
     
        $result         = new stdClass();


        $result->limit  = $this->_limit;
        $result->total  = $this->_total;
 
       
        
        $result->data   = $results;
        
     
        return $result;
    }
    public function createLinks(  ) {
        
        $list_class = 'pagination';
            
        $pages       = ceil($this->_total / $this->_limit);
        $start      = $this->_page;
        
        
        $html       = '<ul class="' . $list_class . '">';
        
       
        if ( $this->_page > 1 ) {
            $html   .= '<li><a href="?page=1">1</a></li>';
            $html   .= '<li class="disabled"><span>...</span></li>';
        }
        for ( $i = $start ; $i <= $pages; $i++ ) {
            
            $class  = ( $this->_page == $i ) ? "active" : "";
            $html   .= '<li class="' . $class . '"><a href="?page=' . $i . '">' . $i . '</a></li>';
            
        }
        if ( $this->_page < $pages && $this->_page > 1 ) {
            $html   .= '<li class="disabled"><span>...</span></li>';
            $html   .= '<li><a href="?page=' . $this->_page . '">' . $pages. '</a></li>';
        }
                
     
        
        $html       .= '</ul>';
        return $html;
    }
     
}







?>