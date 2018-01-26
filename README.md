# iphub
VPN/Proxy/Server Detector using IPHub API

# Installation
composer require finpaytech/iphub

# Requirement
PHP 5.5+ with cURL extension enabled

# Usage Example
```
$ip = $_SERVER['REMOTE_ADDR'];
try {
	$block = IPHub::isBadIP( $ip, "IP HUB API Key" );
	if($block == 1){
		die("Request blocked as you appear to be browsing from a VPN/Proxy/Server. Please contact support if you believe this is a mistake.");		
	}
} catch (\Exception $e) {
	$block = false;
}
```

# API Documentation
API documentation can be found here : https://docs.iphub.info/documentation/