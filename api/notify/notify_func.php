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
        
            $json = json_decode($res);
            http_response_code($json->status);
        } catch (Exception $e) {
            http_response_code(404);
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