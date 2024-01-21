<?php
class Yahoocontacts extends CController{
    // Fill in the next two constants
                    //#################VPS KEYS##################
                    const OAUTH_CONSUMER_KEY = 'dj0yJmk9Y0Z2T0ZRWGlMdXNhJmQ9WVdrOVZEVktlRVpwTXpZbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD04Yg--';
                    const OAUTH_CONSUMER_SECRET = 'f44be44a25ea7b0a5dfe25b99eeb18e4dd26d1fc';
                    
                    //#################TESTIN KEYS##################
                //    define('OAUTH_CONSUMER_KEY', 'dj0yJmk9U1VJZDJNb2JWTUN2JmQ9WVdrOVMzUlNPRW8yTXpRbWNHbzlNQS0tJnM9Y29uc3VtZXJzZWNyZXQmeD03YQ--');
                //    define('OAUTH_CONSUMER_SECRET', '8c9586577b800db338da157d9ae09ad0fa2b23e0');
                    
                    //$progname = $argv[0];
                    public $debug = 0; // Set to 1 for verbose debugging output

                    public function logit($msg,$preamble=true)
                    {
                      //  date_default_timezone_set('America/Los_Angeles');
                      $now = date(DateTime::ISO8601, time());
                      error_log(($preamble ? "+++${now}:" : '') . $msg);
                    }

                    /**
                     * Do an HTTP GET
                     * @param string $url
                     * @param int $port (optional)
                     * @param array $headers an array of HTTP headers (optional)
                     * @return array ($info, $header, $response) on success or empty array on error.
                     */
                    public function do_get($url, $port=80, $headers=NULL)
                    {
                      $retarr = array();  // Return value

                      $curl_opts = array(CURLOPT_URL => $url,
                                         CURLOPT_PORT => $port,
                                         CURLOPT_POST => false,
                                         CURLOPT_SSL_VERIFYHOST => false,
                                         CURLOPT_SSL_VERIFYPEER => false,
                                         CURLOPT_RETURNTRANSFER => true);

                      if ($headers) { $curl_opts[CURLOPT_HTTPHEADER] = $headers; }

                      $response = do_curl($curl_opts);

                      if (! empty($response)) { $retarr = $response; }

                      return $retarr;
                    }

                    /**
                     * Do an HTTP POST
                     * @param string $url
                     * @param int $port (optional)
                     * @param array $headers an array of HTTP headers (optional)
                     * @return array ($info, $header, $response) on success or empty array on error.
                     */
                    public function do_post($url, $postbody, $port=80, $headers=NULL)
                    {
                      $retarr = array();  // Return value

                      $curl_opts = array(CURLOPT_URL => $url,
                                         CURLOPT_PORT => $port,
                                         CURLOPT_POST => true,
                                         CURLOPT_SSL_VERIFYHOST => false,
                                         CURLOPT_SSL_VERIFYPEER => false,
                                         CURLOPT_POSTFIELDS => $postbody,
                                         CURLOPT_RETURNTRANSFER => true);

                      if ($headers) { $curl_opts[CURLOPT_HTTPHEADER] = $headers; }

                      $response = do_curl($curl_opts);

                      if (! empty($response)) { $retarr = $response; }

                      return $retarr;
                    }

                    /**
                     * Make a curl call with given options.
                     * @param array $curl_opts an array of options to curl
                     * @return array ($info, $header, $response) on success or empty array on error.
                     */
                    public function do_curl($curl_opts)
                    {
                      global $debug;

                      $retarr = array();  // Return value

                      if (! $curl_opts) {
                        if ($debug) { logit("do_curl:ERR:curl_opts is empty"); }
                        return $retarr;
                      }


                      // Open curl session
                      $ch = curl_init();

                      if (! $ch) {
                        if ($debug) { logit("do_curl:ERR:curl_init failed"); }
                        return $retarr;
                      }

                      // Set curl options that were passed in
                      curl_setopt_array($ch, $curl_opts);

                      // Ensure that we receive full header
                      curl_setopt($ch, CURLOPT_HEADER, true);

                      if ($debug) {
                        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
                        curl_setopt($ch, CURLOPT_VERBOSE, true);
                      }

                      // Send the request and get the response
                      ob_start();
                      $response = curl_exec($ch);
                      $curl_spew = ob_get_contents();
                      ob_end_clean();
                      if ($debug && $curl_spew){
                        logit("do_curl:INFO:curl_spew begin");
                        logit($curl_spew, false);
                        logit("do_curl:INFO:curl_spew end");
                      }

                      // Check for errors
                      if (curl_errno($ch)) {
                        $errno = curl_errno($ch);
                        $errmsg = curl_error($ch);
                        if ($debug) { logit("do_curl:ERR:$errno:$errmsg"); }
                        curl_close($ch);
                        unset($ch);
                        return $retarr;
                      }

                      if ($debug) {
                        logit("do_curl:DBG:header sent begin");
                        $header_sent = curl_getinfo($ch, CURLINFO_HEADER_OUT);
                        logit($header_sent, false);
                        logit("do_curl:DBG:header sent end");
                      }

                      // Get information about the transfer
                      $info = curl_getinfo($ch);

                      // Parse out header and body
                      $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                      $header = substr($response, 0, $header_size);
                      $body = substr($response, $header_size );

                      // Close curl session
                      curl_close($ch);
                      unset($ch);

                      if ($debug) {
                        logit("do_curl:DBG:response received begin");
                        if (!empty($response)) { logit($response, false); }
                        logit("do_curl:DBG:response received end");
                      }

                      // Set return value
                      array_push($retarr, $info, $header, $body);

                      return $retarr;
                    }

                    /**
                     * Pretty print some JSON
                     * @param string $json The packed JSON as a string
                     * @param bool $html_output true if the output should be escaped
                     * (for use in HTML)
                     * @link http://us2.php.net/manual/en/function.json-encode.php#80339
                     */
                    public function json_pretty_print($json, $html_output=false)
                    {
                      $spacer = '  ';
                      $level = 1;
                      $indent = 0; // current indentation level
                      $pretty_json = '';
                      $in_string = false;

                      $len = strlen($json);

                      for ($c = 0; $c < $len; $c++) {
                        $char = $json[$c];
                        switch ($char) {
                        case '{':
                        case '[':
                          if (!$in_string) {
                            $indent += $level;
                            $pretty_json .= $char . "\n" . str_repeat($spacer, $indent);
                          } else {
                            $pretty_json .= $char;
                          }
                          break;
                        case '}':
                        case ']':
                          if (!$in_string) {
                            $indent -= $level;
                            $pretty_json .= "\n" . str_repeat($spacer, $indent) . $char;
                          } else {
                            $pretty_json .= $char;
                          }
                          break;
                        case ',':
                          if (!$in_string) {
                            $pretty_json .= ",\n" . str_repeat($spacer, $indent);
                          } else {
                            $pretty_json .= $char;
                          }
                          break;
                        case ':':
                          if (!$in_string) {
                            $pretty_json .= ": ";
                          } else {
                            $pretty_json .= $char;
                          }
                          break;
                        case '"':
                          if ($c > 0 && $json[$c-1] != '\\') {
                            $in_string = !$in_string;
                          }
                        default:
                          $pretty_json .= $char;
                          break;
                        }
                      }

                      return ($html_output) ?
                        '<pre>' . htmlentities($pretty_json) . '</pre>' :
                        $pretty_json . "\n";
                    }

                    public function callcontact_yahoo($consumer_key, $consumer_secret, $guid, $access_token, $access_token_secret, $usePost=false, $passOAuthInHeader=true)
                    {
                      $retarr = array();  // return value
                      $response = array();

                      $url = 'https://social.yahooapis.com/v1/user/' . $guid . '/contacts;count=1000';
                      $params['format'] = 'json';
                      $params['view'] = 'compact';
                      $params['oauth_version'] = '1.0';
                      $params['oauth_nonce'] = mt_rand();
                      $params['oauth_timestamp'] = time();
                      $params['oauth_consumer_key'] = $consumer_key;
                      $params['oauth_token'] = $access_token;

                      // compute hmac-sha1 signature and add it to the params list
                      $params['oauth_signature_method'] = 'HMAC-SHA1';
                      $params['oauth_signature'] =
                          oauth_compute_hmac_sig($usePost? 'POST' : 'GET', $url, $params,
                                                 $consumer_secret, $access_token_secret);

                      // Pass OAuth credentials in a separate header or in the query string
                      if ($passOAuthInHeader) {
                        $query_parameter_string = oauth_http_build_query($params, true);
                        $header = build_oauth_header($params, "yahooapis.com");
                        $headers[] = $header;
                      } else {
                        $query_parameter_string = oauth_http_build_query($params);
                      }

                      // POST or GET the request
                      if ($usePost) {
                        $request_url = $url;
                        logit("callcontact:INFO:request_url:$request_url");
                        logit("callcontact:INFO:post_body:$query_parameter_string");
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                        $response = do_post($request_url, $query_parameter_string, 443, $headers);
                      } else {
                        $request_url = $url . ($query_parameter_string ?
                                               ('?' . $query_parameter_string) : '' );
                        logit("callcontact:INFO:request_url:$request_url");
                        $response = do_get($request_url, 443, $headers);
                      }
                      $yahoo_array = array();
                      /*$newList	= "<table>
                                                    <tr><td>Name </td><td>Email </td><td><a href='javascript:;' class='select_bt'>Select All</a>/<a href='javascript:;' class='clear_bt'>Clear All</a></td>
                                                    </tr>";*/
                            $newList = "";
                      // extract successful response
                      if (! empty($response)) {
                        list($info, $header, $body) = $response;
                        if ($body) {
                          //logit("callcontact:INFO:response:");
                          //print(json_pretty_print($body));
                              $yahoo_array = json_decode($body);

                             echo "<pre/>";
                             //print_r($yahoo_array);
                             foreach($yahoo_array as $key=>$values){
                                     foreach($values->contact as $keys=>$values_sub){
                                            // echo '<pre/>';
                                            // print_r($values_sub);
                                             $data[$keys]['name'] = $values_sub->fields[0]->value->givenName;
                                             $data[$keys]['email'] = $values_sub->fields[1]->value;

                                            //if(trim($email)!="")
                                            //$newList   .= $email.",";

                                     }
                             }

                        }
                        $retarr = $data;
                      }

                      return $retarr;
                    }
                    
                    public function get_access_token_yahoo($consumer_key, $consumer_secret, $request_token, $request_token_secret, $oauth_verifier, $usePost=false, $useHmacSha1Sig=true, $passOAuthInHeader=true)
                    {
                      $retarr = array();  // return value
                      $response = array();
                      $url = 'https://api.login.yahoo.com/oauth/v2/get_token';
                      $params['oauth_version'] = '1.0';
                      $params['oauth_nonce'] = mt_rand();
                      $params['oauth_timestamp'] = time();
                      $params['oauth_consumer_key'] = $consumer_key;
                      $params['oauth_token']= $request_token;
                      $params['oauth_verifier'] = $oauth_verifier;

                      // compute signature and add it to the params list
                      if ($useHmacSha1Sig) {
                        $params['oauth_signature_method'] = 'HMAC-SHA1';
                        $params['oauth_signature'] =
                          oauth_compute_hmac_sig($usePost? 'POST' : 'GET', $url, $params,
                                                 $consumer_secret, $request_token_secret);
                      } else {
                        $params['oauth_signature_method'] = 'PLAINTEXT';
                        $params['oauth_signature'] =
                          oauth_compute_plaintext_sig($consumer_secret, $request_token_secret);
                      }

                      // Pass OAuth credentials in a separate header or in the query string
                      if ($passOAuthInHeader) {
                        $query_parameter_string = oauth_http_build_query($params, false);
                        $header = build_oauth_header($params, "yahooapis.com");
                        $headers[] = $header;
                      } else {
                        $query_parameter_string = oauth_http_build_query($params);
                      }

                      // POST or GET the request
                      if ($usePost) {
                        $request_url = $url;
                        logit("getacctok:INFO:request_url:$request_url");
                        logit("getacctok:INFO:post_body:$query_parameter_string");
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                        $response = do_post($request_url, $query_parameter_string, 443, $headers);
                      } else {
                        $request_url = $url . ($query_parameter_string ?
                                               ('?' . $query_parameter_string) : '' );
                        logit("getacctok:INFO:request_url:$request_url");
                        $response = do_get($request_url, 443, $headers);
                      }

                      // extract successful response
                      if (! empty($response)) {
                        list($info, $header, $body) = $response;
                        $body_parsed = oauth_parse_str($body);
                        if (! empty($body_parsed)) {
                          logit("getacctok:INFO:response_body_parsed:");
                         // print_r($body_parsed);
                        }
                        $retarr = $response;
                        $retarr[] = $body_parsed;
                      }

                      return $retarr;
                    }

                    /* Function added for getting the request token */
                    public function get_request_token($consumer_key, $consumer_secret, $callback, $usePost=false, $useHmacSha1Sig=true, $passOAuthInHeader=false)
                    {



                      $retarr = array();  // return value
                      $response = array();

                      $url = 'https://api.login.yahoo.com/oauth/v2/get_request_token';
                      $params['oauth_version'] = '1.0';
                      $params['oauth_nonce'] = mt_rand();
                      $params['oauth_timestamp'] = time();
                      $params['oauth_consumer_key'] = $consumer_key;
                      $params['oauth_callback'] = $callback;

                      // compute signature and add it to the params list
                      if ($useHmacSha1Sig) {
                        $params['oauth_signature_method'] = 'HMAC-SHA1';
                        $params['oauth_signature'] =
                          oauth_compute_hmac_sig($usePost? 'POST' : 'GET', $url, $params,
                                                 $consumer_secret, null);
                      } else {
                        $params['oauth_signature_method'] = 'PLAINTEXT';
                        $params['oauth_signature'] =
                          oauth_compute_plaintext_sig($consumer_secret, null);
                      }

                      // Pass OAuth credentials in a separate header or in the query string
                      if ($passOAuthInHeader) {

                        $query_parameter_string = oauth_http_build_query($params, FALSE);

                        $header = build_oauth_header($params, "yahooapis.com");
                        $headers[] = $header;
                      } else {
                        $query_parameter_string = oauth_http_build_query($params);
                      }

                      // POST or GET the request
                      if ($usePost) {
                        $request_url = $url;
                        logit("getreqtok:INFO:request_url:$request_url");
                        logit("getreqtok:INFO:post_body:$query_parameter_string");
                        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                        $response = do_post($request_url, $query_parameter_string, 443, $headers);
                      } else {
                        $request_url = $url . ($query_parameter_string ?
                                               ('?' . $query_parameter_string) : '' );

                        logit("getreqtok:INFO:request_url:$request_url");

                        $response = do_get($request_url, 443, $headers);

                      }

                      // extract successful response
                      if (! empty($response)) {
                        list($info, $header, $body) = $response;
                        $body_parsed = oauth_parse_str($body);
                        if (! empty($body_parsed)) {
                          logit("getreqtok:INFO:response_body_parsed:");
                          //print_r($body_parsed);
                        }
                        $retarr = $response;
                        $retarr[] = $body_parsed;
                      }

                      return $retarr;
                    }

        
        
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
        //#####################OAUTH.PHP##########33
            public function oauth_http_build_query($params, $excludeOauthParams=false)
            {
              $query_string = '';
              if (! empty($params)) {

                // rfc3986 encode both keys and values
                $keys = rfc3986_encode(array_keys($params));
                $values = rfc3986_encode(array_values($params));
                $params = array_combine($keys, $values);

                // Parameters are sorted by name, using lexicographical byte value ordering.
                // http://oauth.net/core/1.0/#rfc.section.9.1.1
                uksort($params, 'strcmp');

                // Turn params array into an array of "key=value" strings
                $kvpairs = array();
                foreach ($params as $k => $v) {
                  if ($excludeOauthParams && substr($k, 0, 5) == 'oauth') {
                    continue;
                  }
                  if (is_array($v)) {
                    // If two or more parameters share the same name,
                    // they are sorted by their value. OAuth Spec: 9.1.1 (1)
                    natsort($v);
                    foreach ($v as $value_for_same_key) {
                      array_push($kvpairs, ($k . '=' . $value_for_same_key));
                    }
                  } else {
                    // For each parameter, the name is separated from the corresponding
                    // value by an '=' character (ASCII code 61). OAuth Spec: 9.1.1 (2)
                    array_push($kvpairs, ($k . '=' . $v));
                  }
                }

                // Each name-value pair is separated by an '&' character, ASCII code 38.
                // OAuth Spec: 9.1.1 (2)
                $query_string = implode('&', $kvpairs);
              }

              return $query_string;
            }

            /**
             * Parse a query string into an array.
             * @param string $query_string an OAuth query parameter string
             * @return array an array of query parameters
             * @link http://oauth.net/core/1.0/#rfc.section.9.1.1
             */
            public function oauth_parse_str($query_string)
            {
              $query_array = array();

              if (isset($query_string)) {

                // Separate single string into an array of "key=value" strings
                $kvpairs = explode('&', $query_string);

                // Separate each "key=value" string into an array[key] = value
                foreach ($kvpairs as $pair) {
                  list($k, $v) = explode('=', $pair, 2);

                  // Handle the case where multiple values map to the same key
                  // by pulling those values into an array themselves
                  if (isset($query_array[$k])) {
                    // If the existing value is a scalar, turn it into an array
                    if (is_scalar($query_array[$k])) {
                      $query_array[$k] = array($query_array[$k]);
                    }
                    array_push($query_array[$k], $v);
                  } else {
                    $query_array[$k] = $v;
                  }
                }
              }

              return $query_array;
            }

            /**
             * Build an OAuth header for API calls
             * @param array $params an array of query parameters
             * @return string encoded for insertion into HTTP header of API call
             */
            public function build_oauth_header($params, $realm='')
            {
              $header = 'Authorization: OAuth realm="' . $realm . '"';
              foreach ($params as $k => $v) {
                if (substr($k, 0, 5) == 'oauth') {
                  $header .= ',' . rfc3986_encode($k) . '="' . rfc3986_encode($v) . '"';
                }
              }
              return $header;
            }

            /**
             * Compute an OAuth PLAINTEXT signature
             * @param string $consumer_secret
             * @param string $token_secret
             */
            public function oauth_compute_plaintext_sig($consumer_secret, $token_secret)
            {
              return ($consumer_secret . '&' . $token_secret);
            }

            /**
             * Compute an OAuth HMAC-SHA1 signature
             * @param string $http_method GET, POST, etc.
             * @param string $url
             * @param array $params an array of query parameters for the request
             * @param string $consumer_secret
             * @param string $token_secret
             * @return string a base64_encoded hmac-sha1 signature
             * @see http://oauth.net/core/1.0/#rfc.section.A.5.1
             */
            public function oauth_compute_hmac_sig($http_method, $url, $params, $consumer_secret, $token_secret)
            {
              global $debug;

              $base_string = signature_base_string($http_method, $url, $params);
              $signature_key = rfc3986_encode($consumer_secret) . '&' . rfc3986_encode($token_secret);
              $sig = base64_encode(hash_hmac('sha1', $base_string, $signature_key, true));
              if ($debug) {
                logit("oauth_compute_hmac_sig:DBG:sig:$sig");
              }
              return $sig;
            }

            /**
             * Make the URL conform to the format scheme://host/path
             * @param string $url
             * @return string the url in the form of scheme://host/path
             */
            public function normalize_url($url)
            {
              $parts = parse_url($url);

              $scheme = $parts['scheme'];
              $host = $parts['host'];
              //$port = $parts['port'];
              $port = null;
              $path = $parts['path'];

              if (! $port) {
                $port = ($scheme == 'https') ? '443' : '80';
              }
              if (($scheme == 'https' && $port != '443')
                  || ($scheme == 'http' && $port != '80')) {
                $host = "$host:$port";
              }

              return "$scheme://$host$path";
            }

            /**
             * Returns the normalized signature base string of this request
             * @param string $http_method
             * @param string $url
             * @param array $params
             * The base string is defined as the method, the url and the
             * parameters (normalized), each urlencoded and the concated with &.
             * @see http://oauth.net/core/1.0/#rfc.section.A.5.1
             */
            public function signature_base_string($http_method, $url, $params)
            {
              // Decompose and pull query params out of the url
              $query_str = parse_url($url, PHP_URL_QUERY);
              if ($query_str) {
                $parsed_query = oauth_parse_str($query_str);
                // merge params from the url with params array from caller
                $params = array_merge($params, $parsed_query);
              }

              // Remove oauth_signature from params array if present
              if (isset($params['oauth_signature'])) {
                unset($params['oauth_signature']);
              }

              // Create the signature base string. Yes, the $params are double encoded.
              $base_string = rfc3986_encode(strtoupper($http_method)) . '&' .
                             rfc3986_encode(normalize_url($url)) . '&' .
                             rfc3986_encode(oauth_http_build_query($params));

              logit("signature_base_string:INFO:normalized_base_string:$base_string");

              return $base_string;
            }

            /**
             * Encode input per RFC 3986
             * @param string|array $raw_input
             * @return string|array properly rfc3986 encoded raw_input
             * If an array is passed in, rfc3896 encode all elements of the array.
             * @link http://oauth.net/core/1.0/#encoding_parameters
             */
            public function rfc3986_encode($raw_input)
            {
              if (is_array($raw_input)) {
                return array_map('rfc3986_encode', $raw_input);
              } else if (is_scalar($raw_input)) {
                return str_replace('%7E', '~', rawurlencode($raw_input));
              } else {
                return '';
              }
            }

            public function rfc3986_decode($raw_input)
            {
              return rawurldecode($raw_input);
            }                                                                                                    

        
}