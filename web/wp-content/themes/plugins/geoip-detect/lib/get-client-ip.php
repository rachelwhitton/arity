<?php

/*
Copyright 2013-2018 Yellow Tree, Siegen, Germany
Author: Benjamin Pick (wp-geoip-detect| |posteo.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace YellowTree\GeoipDetect\Lib;

class GetClientIp {
	protected $proxyWhitelist = [];
	protected $useProxyWhitelist = false;
	
	public function __construct() {
		$this->proxyWhitelist[] = '';
		$this->proxyWhitelist[] = '::1';
		$this->proxyWhitelist[] = '127.0.0.1';
	}
	
	public function addProxiesToWhitelist($trusted_proxies) {
		foreach ($trusted_proxies as $proxy) {
			$proxy = geoip_detect_normalize_ip($proxy);
			if ($proxy) {
				$this->proxyWhitelist[] = $proxy;
				$this->useProxyWhitelist = true;
			}
		}
	}
	
	protected function getIpsFromRemoteAddr() {
		if (!isset($_SERVER['REMOTE_ADDR']))
			return ['::1'];

		// REMOTE_ADDR may contain multiple adresses
		$ip_list = explode(',', $_SERVER['REMOTE_ADDR']);
		
		return $ip_list;
	}
	
	protected function getIpsFromForwardedFor($currentIpList) {
		$ip_list_reverse = explode(',', @$_SERVER["HTTP_X_FORWARDED_FOR"]);

		if ($this->useProxyWhitelist) {
			// Add the REMOTE_ADDR to the available IP pool
			$ip_list_reverse = array_merge($ip_list_reverse, $currentIpList);
			$ip_list_reverse = array_map('geoip_detect_normalize_ip', $ip_list_reverse);
			$ip_list_reverse = array_diff($ip_list_reverse, $this->proxyWhitelist);
		}
		
		return $ip_list_reverse;
	}
	
	public function getIp($useReverseProxy = false) {
		$ip_list = $this->getIpsFromRemoteAddr();

		if ($useReverseProxy)
		{
			$ip_list = $this->getIpsFromForwardedFor($ip_list);
		}	
		
		// Each Proxy server append their information at the end, so the last IP is most trustworthy.
		$ip = end($ip_list);
		$ip = geoip_detect_normalize_ip($ip);

		if (!geoip_detect_is_ip($ip))
			$ip = '::1'; // By default, use localhost

		// this is the correct one!
		$ip = apply_filters('geoip_detect2_client_ip', $ip, $ip_list);

		return $ip;
	}
}