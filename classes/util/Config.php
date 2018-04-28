<?php

/**
 * Config configuration object class.
 * 
 * @author josivanSilva(Developer);
 *
 */
class Config {
  
  private $configFile = '../../../config/app-config.xml';

  private $items = array();

  function __construct() { 
  	$this->parse(); 
  }

  public function __get ($id) { 
  	return $this->items[ $id ]; 
  }

  private function parse() {
    $doc = new DOMDocument();
    $doc->load( $this->configFile );

    $cn = $doc->getElementsByTagName( "config" );

    $nodes = $cn->item(0)->getElementsByTagName( "*" );
    foreach( $nodes as $node )
      $this->items[ $node->nodeName ] = $node->nodeValue;
  }
  
}

/*$c = new Config();
echo( $c->TemplateDirectory."\n" );*/

?>