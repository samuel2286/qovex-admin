<?php

if(!function_exists('route_is')){
    function route_is($route=null){
        if(Request::routeIs($route)){
            return true;
        }else{
            return false;
        }
    }
}

if(!function_exists('route_is')){
    function route_is($routes=[]){
        foreach($routes as $route){
            if(Request::routeIs($route)){
                return true;
            }else{
                return false;
            }
        }
    }
}

if(!function_exists('notify')){
    function notify($message , $type='success'){
        return array(
            'message'=> $message,
            'alert-type' => $type,
        );
    }
}

if(!function_exists('alert')){
    function alert($message , $type='success'){
        return array(
            'message'=> $message,
            'alert-type' => $type,
        );
    }
}

function sendSMS($phone, $message)
	{

		$sender = "";

		// SEND SMS
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => 'https://sms.arkesel.com/api/v2/sms/send',
			CURLOPT_HTTPHEADER => ["api-key: OlUzeHhQQTd4bjhZMXQwMWI="],
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => http_build_query([
				'sender' => $sender,
				'message' => $message,
				'recipients' => explode(',',$phone)
			]),
		]);
		$response = json_decode(curl_exec($curl));
		curl_close($curl);
		return ($response->status == 'success') ? TRUE: FALSE;
	}

    function random_str(
        int $length = 64,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ): string {
        $keyspace = str_shuffle($keyspace );
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    if(!function_exists('json_parse')){
        function json_parse(array $data){
            return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
        }
    }
