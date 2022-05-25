<?php
    $header = "ทดสอบการติดต่อ";
    $firstname = $_POST['first-name'];
    $lastname = $_POST['last-name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $detail = $_POST['message:'];
    

    $message = $header.
                "\n"."ชื่อจริง: ".$firstname .
                "\n"."นามสกุล: ".$lastname .
                "\n"."อีเมล: ".$email .
                "\n"."เบอร์ติดต่อ: ".$phone .
                "\n"."รายละเอียด: ".$detail;
                

        
        if($firstname <> "" ||
           $lastname <> "" ||
           $phone <> "" ||
           $message <> "") {
               sendlinemsg();
               header('Content-Type: text/html; charset=utf8');
               $res = notify_message($message);
               echo '<script>alert("ส่งข้อมูลสำเร็จ กรุณารอการติดต่อกลับประมาณ 1-2 วัน");location.href="contact.php";</script>';
           }
           else {
               echo '<script>alert("ส่งข้อมูลไม่สำเร็จกรุณาลองอีกครั้ง");location.href="contact.php";</script>';
           }

    function sendlinemsg() {

        define('LINE_API',"https://notify-api.line.me/api/notify");
        define('LINE_TOKEN',"9zxeReZ6UdFneTNvzpFgr0Vp8htVSrpe9U0obPtxnyr");

        function notify_message($message) {
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                                ."Authorization: Bearer ".LINE_TOKEN."\r\n"
                                ."Content-Length: ".strlen($queryData)."\r\n" ,
                    'content' => $queryData
                )
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API,FALSE,$context);
            $res = json_decode($result);
            return $res;
        }
    }
                
?>