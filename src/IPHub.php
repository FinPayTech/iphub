<?php
namespace FinPayTech\IPHub;
class IPHub {
	public static function isBadIP($ip, $key, $strict = false) {
		$ch = curl_init();
		$endPoint	=	"http://v2.api.iphub.info/ip/{$ip}";
		curl_setopt_array($ch, [
			CURLOPT_URL => $endPoint,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => [ "X-Key: {$key}" ]
		]);
		try {
			$response = curl_exec($ch);
			$curlError	=	curl_error($ch);
			if($curlError){
				throw new \Exception(sprintf("cURL Error(%d): %s", curl_errno($ch), $curlError));
			}else{
				$responseHttpCode	=	curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
				if($responseHttpCode == 200){
					$responseObject	=	json_decode($response);
					if( isset( $responseObject->block ) ){
						$block	=	$responseObject->block;
					}else{
						throw new \Exception($responseObject->message);
					}
				}else{
					throw new \Exception(sprintf("Request to %s ended in %d", $endPoint, $httpCresponseHttpCodeode));
				}
			}
		}catch(\Exception $e){
			throw $e;
		}
		if ($block) {
			if ($strict) {
				return true;
			} elseif (!$strict && $block === 1) {
				return true;
			}
		}
		return false;
	}
}