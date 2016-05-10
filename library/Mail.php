<?php 
    
    class Mail {
        
        /**
         * @return Zend_Mail
         */
        public static function factory(){
            $mail = new Zend_Mail('UTF-8');            
            $mail->setFrom('admin@givenchy.com', 'GIVENCHY');
            $transport = self::transportFactory();
            if( $transport ){
                $mail->setDefaultTransport($transport);
            }
            return $mail;
        }
                
        public static function transportFactory($config=null){
            $conf['smtp'] = '1';
            $conf['host'] = "smtp.gmail.com";
            $conf['port'] = '587';
            $conf['auth'] = 'login';
            $conf['username'] = 'entropy359@gmail.com';
            $conf['password'] = 'chaos359';
            $conf['ssl'] = "tls";
            
            if( is_array($config) ){
                foreach( $conf as $key => $value ){
                    if( array_key_exists($key, $config) ){
                        $conf[$key] = $config[$key];
                    }
                }
            }
            
            $transport = null;
            
            if( $conf['smtp'] ){
                $host = $conf['host'];
                unset($conf['smtp']);
                unset($conf['host']);
                $transport = new Zend_Mail_Transport_Smtp($host, $conf);
            }
            
            return $transport;
        }
    }