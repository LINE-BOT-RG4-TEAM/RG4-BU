<?php
    define('LINE_API_URI', 'https://notify-api.line.me/api/notify');

    /*
     *  send a notify to PEA Officer
     *  params $userId = unique id from 
     *  params $messages = list of messages
     */
    function notifyToOfficer($accessToken, $message){
    
        $headers = [
            'Authorization: Bearer ' . $accessToken
        ];

        $fields = [
            'message' => $message
        ];

        try {
            $ch = curl_init();
        
            curl_setopt($ch, CURLOPT_URL, LINE_API_URI);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $res = curl_exec($ch);
            curl_close($ch);
        
            if ($res == false)
                throw new Exception(curl_error($ch), curl_errno($ch));
        
            $json = json_decode($res);
            $status = $json->status;
        
            var_dump($status);
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    /*
     * find a information by purchase id
     */
    function notifyAllOfficerByPurchaseId($conn, $purchaseId){
        /*
         * 1. ดึง userId จากตาราง purchase โดย $purchaseId
         * 2. นับจำนวนสินค้าจากตาราง  lineitem 
         * 3. นำข้อมูลไป join กับตาราง ca เพื่อดึงสังกัดที่ ca ดังกล่าวอยู่
         * 4. ดึงพนักงานที่สังกัดอยู่ในจาก ข้อ 3. และแจ้งเตือนไปถึง
         */
    }