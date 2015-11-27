<?php 

class UrlDetection {
  function __construct() {
    if( ! isset( $_POST['url'] ) )
      die();
    
    $this->init();
  }
  
  function init() {
    $url   = $_POST['url'];
    $url   = str_replace( 'http://', 'https://', $url );
    $url   = $this->getOriginalURL( $url );
    $agent = 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36';
    
    // create curl resource 
    $ch = curl_init(); 

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0 );
    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_HEADERFUNCTION, array( $this, 'HandleHeaderLine' ) );
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);

    $output = curl_exec($ch); 

    // close curl resource to free up system resources 
    curl_close($ch);

    global $headers;

    $method = false;

    foreach( (array) $headers as $k => $header ) {
      if( preg_match( '#(HTTP\/2[0-9\.]+)\s#', $header, $m ) ) {
        $method = $m[1];
        break;
      }
    }

    $out = array(
      'success' => false,
      'headers' => implode( '<br />', (array) $headers )
    );

    if( 'HTTP/2' == $method || 'HTTP/2.0' == $method )
      $out['success'] = true;
      
    header('Content-Type: application/json');
    echo json_encode( $out );
    die();
  }
  
  function HandleHeaderLine( $curl, $header_line ) {
    global $headers;
    $headers[] = $header_line;
    return strlen($header_line);
  }
  
  function getOriginalURL($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, true);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $result = curl_exec($ch);
      $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
      curl_close($ch);


      // if it's not a redirection (3XX), move along
      if ($httpStatus < 300 || $httpStatus >= 400)
          return $url;

      // look for a location: header to find the target URL
      if(preg_match('/location: (.*)/i', $result, $r)) {
          $location = trim($r[1]);

          // if the location is a relative URL, attempt to make it absolute
          if (preg_match('/^\/(.*)/', $location)) {
              $urlParts = parse_url($url);
              if ($urlParts['scheme'])
                  $baseURL = $urlParts['scheme'].'://';

              if ($urlParts['host'])
                  $baseURL .= $urlParts['host'];

              if ($urlParts['port'])
                  $baseURL .= ':'.$urlParts['port'];

              return $baseURL.$location;
          }

          return $location;
      }
      return $url;
  }
}
new UrlDetection();
