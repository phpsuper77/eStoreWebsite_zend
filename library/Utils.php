<?php 

	class Utils {

        /**
         * @return Employee|null
         */
        public static function user(){
            $user = new Zend_Session_Namespace('user');
            if ( $user->id == NULL ) return null;
            
            $client = new Clientes($user->id);
            return $client;
        }
        
        public static function adminuser(){
            $user = new Zend_Session_Namespace('adminuser');
            if ( $user->id == NULL ) return null;
            
            $client = new Users($user->id);
            return $client;
        }

		public static function numberFormat($number){
			return number_format($number, 2, Constants::DECIMAL_SEPARATOR, Constants::THOUSANDS_SEPARATOR);
		}
		
		public static function addVAT($number, $vat){
			return $number * (1 + ($vat/100));
		}
		
		public static function removeVAT($number, $vat){
			return $number / (1 + ($vat/100)); 
		}
		
		public static function totalVAT($number, $vat=Constants::VAT){
			return $number - self::removeVAT($number, $vat);
		}
		
		public static function contactNumberFormat($id){
			return self::generalFormat($id, Constants::CONTACT_NUMBER_PREFIX, '', Constants::CONTACT_NUM_PADDING, '0');
		}

        public static function wholesalerNumberFormat($id){
            return self::generalFormat($id, Constants::WHOLESALER_NUMBER_PREFIX, '', Constants::WHOLESALER_NUM_PADDING, '0');
        }
		
		public static function generalFormat($thing, $prefix='', $suffix='', $length=null, $padding='', $paddingSide='left', $format='%s'){
			$result[0] = $prefix;
			$result[2] = sprintf($format, $thing);
			$result[4] = $suffix;
			
			if( $length && ($left = $length - iconv_strlen($thing, 'UTF-8')) > 0 ){
				$pad = str_repeat($padding, $left);
				$index = $paddingSide == "left" ? 1 : 3;
				$result[$index] = $pad;
			}
			
			ksort($result);
			return join('', $result);
		}

        public static function strip_bad_tags($html, $appendTags=""){
            $html = preg_replace('@<mark>(.*)</mark>@', '<span style="background-color:#ffff00;">$1</span>', $html);
            $html = preg_replace('@<lt>(.*)</lt>@', '<strike>$1</strike>', $html);

            if( !function_exists('replace_link') ){
                function replace_link($match){
                    $href = $match = trim(end($match));
                    $href = parse_url($match, PHP_URL_SCHEME) ? $href : 'http://' . $href;
                    return '<a href="' . $href . '">' . $match . '</a>';
                }
            }

            $html = preg_replace_callback('@<link>(.*)</link>@', 'replace_link', $html);


            return strip_tags($html, "<mark><b><strong><strike><i><u><font><p><h1><h2><h3><h4><h5><h6><a><em><small><quote><div><span><br><hr><br/><hr/><form><input><input/><button><table><tr><th><td><img><img/><textarea><li><ul><ol><del><cite>" . $appendTags);
        }

        public static function name2date($type, $now=null){
            $now = $now !== null ? $now : time();

            switch( $type ){
                case 'last_month':
                    $df = mktime(0,0,0, date('m', $now)-1, date('d', $now), date('y', $now));
                    $dt = mktime(0, 0, -1, date('m', $now), 1, date('y', $now));
                    break;

                case 'this_month':
                    $df = mktime(0,0,0, date('m', $now), 1, date('y', $now));
                    $dt = mktime(0, 0, -1, date('m', $now) + 1, 1, date('y', $now));
                    break;

                case 'last_quarter':
                    $df = mktime(0,0,0, ceil((date('m', $now)-3)/3) * 3 - 2, 1, date('y', $now));
                    $dt = mktime(0,0,-1, ceil((date('m', $now)-3)/3) * 3 + 1, 1, date('y', $now));
                    break;

                case 'this_quarter':
                    $df = mktime(0,0,0, ceil(date('m', $now)/3) * 3 - 2, 1, date('y', $now));
                    $dt = mktime(0,0,-1, ceil(date('m', $now)/3) * 3 + 1, 1, date('y', $now));
                    break;

                case 'last_year':
                    $df = mktime(0,0,0, 1, 1, date('y')-1);
                    $dt = mktime(0,0,-1, 1, 1, date('y'));
                    break;

                case 'this_year':
                    $df = mktime(0,0,0, 1, 1, date('y'));
                    $dt = mktime(0,0,-1, 1, 1, date('y')+1);
                    break;

                default:
                    throw new Exception('Non supported date format!');
                    break;

            }

            return array($df, $dt);
        }
        
        /**
         * @return Contact|null
         */
        public static function contact(){
            $contact = new Zend_Session_Namespace('contact');
            $customer = new Contact($contact->id);
            return $customer->exists() ? $customer : null ;
        }
        
        public static function cart(){
            $cart = new Zend_Session_Namespace('cart');
            $mydata = $cart->data;
            return $mydata;
        }

        public static function activity($action, $target, $target_id=null){
            $log = new ActivityLog();
            $log->action = $action;
            $log->target = $target;
            $log->target_id = $target_id;       
            $log->employee_id = Utils::user()->id;
            $log->created_time = time();
            $log->params = serialize(Zend_Controller_Front::getInstance()->getRequest()->getParams());
            $log->save();
        }
	}
