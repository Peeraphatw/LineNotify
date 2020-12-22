<?php
date_default_timezone_set('Asia/Bangkok');

    class notify_line{

        var $title;
        var $message;
        var $sender;
        var $date;      
        var $host = "localhost"; 
		var $user = "root"; 
		var $pass = ""; 
		var $db = "Notify_db"; 
        var $con;
        
        
		
		public function con_db()
		{
			$this->con = mysqli_connect($this->host,$this->user,$this->pass,$this->db)or die("Error : Cannot Connect To Database");
            mysqli_query($this->con,"SET NAMES 'utf8'");
            
            return $this->con;
		}

        public function set_message ($title,$message,$sender){ //set message for all
            $this->title = $title;
            $this->message = $message;
            $this->sender = $sender;
            $fullmessage = $this->title."\n \n".$this->message."\n \n".$this->sender;

            return $fullmessage;
        }

        public function notify_date($id,$table){    //update sent date for all
            $this->date = date("d/m/y");
            $sql = "UPDATE $table SET SENT = '$this->date' WHERE ID = '$id'";
            $query = mysqli_query($this->con,$sql);
        }
        public function notify_Time($id,$table){    //update sent date for all
            $this->date = date("h:i A");
            $sql = "UPDATE {$table} SET SENT_Time = '$this->date' WHERE ID = '$id'";
            $query = mysqli_query($this->con,$sql);
        }


        public function token_set($grouppost){ // set token by select array and foreach to get token_set for all

            $group = (explode(",",$grouppost)); //get string grouppost coverto array

            foreach($group as $grouparr){ //get toke from $group

            $sql = "SELECT Token  FROM notify_token WHERE GroupName = '$grouparr'";
            $exc = $this->con->query($sql);
            $row = $exc->fetch_array();
            $token[] = $row['Token'];
            }
        
            return $token;
        }

        function notify_message($message,$token){ //sent notify for all
            $queryData = array('message' => $message);
            $queryData = http_build_query($queryData,'','&');
            $headerOptions = array( 
                    'http'=>array(
                       'method'=>'POST',
                       'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                                 ."Authorization: Bearer ".$token."\r\n"
                                 ."Content-Length: ".strlen($queryData)."\r\n",
                       'content' => $queryData
                    ),
            );
            $context = stream_context_create($headerOptions);
            $result = file_get_contents(LINE_API,FALSE,$context);
            $res = json_decode($result);
            if($res){
                return TRUE;
            }else{
                return FALSE;
            }
           }

        // function notify_message($message,$Token)
        //     {
        //         $lineapi = $Token; 
        //         $mms =  trim($message);
        //         date_default_timezone_set("Asia/Bangkok");
        //         $cha = curl_init(); 
        //         curl_setopt( $cha, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        //         // SSL USE 
        //         curl_setopt( $cha, CURLOPT_SSL_VERIFYHOST, 0); 
        //         curl_setopt( $cha, CURLOPT_SSL_VERIFYPEER, false);  //false for HTTPS
        //         //POST 
        //         curl_setopt( $cha, CURLOPT_POST, 1); 
        //         curl_setopt( $cha, CURLOPT_POSTFIELDS, "message=$mms"); 
        //         curl_setopt( $cha, CURLOPT_FOLLOWLOCATION, 1); 
        //         $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$lineapi.'', );
        //             curl_setopt($cha, CURLOPT_HTTPHEADER, $headers); 
        //         curl_setopt( $cha, CURLOPT_RETURNTRANSFER, 1); 
        //         $result = curl_exec( $cha ); 
        //         //Check error 
        //         if(curl_error($cha)) 
        //         { 
        //             echo 'error:' . curl_error($cha); 
        //         } 
        //         else { 
        //         $result_ = json_decode($result, TRUE);
        //         if($result_){

        //             return TRUE;

        //         }else{

        //             return FALSE;
        //         }  
        //             } 
        //         curl_close( $cha );
                  
        //     }

           function get_approver($department){ //not use

                $sql = "SELECT Username FROM notify_user WHERE Priority = 'Hight' AND Department ='$department'";
                $exc = $this->con->query($sql);
                $row = $exc->fetch_array();
                
                return $row;
                
           }

           function approve($id,$table){ //get approve date
               $time = date("h:i A");
               $sql = "UPDATE {$table} SET Approve_Status ='Approve', Approve_Time = '$time' WHERE ID = '$id'";
               $exc = $this->con->query($sql);
               
            if($exc){
                return TRUE;
            }
           }

           function abort($id,$table){ //get approve date
            $time = date("h:i A");
            $sql = "UPDATE {$table} SET Approve_Status ='Abort', Approve_Time = '$time' WHERE ID = '$id'";
            $exc = $this->con->query($sql);
            if($exc){
                return TRUE;
            }
         }
        
        
        

    }
    // $t = new notify_line();
    // $t->con_db();
    // echo $t->approve(28,"notify_daily")

    
    // $n = new notify_line();
    // echo $msg = $n->set_message("test","lorem80","Peara");
//     // print $msg;
//     $department = array('ACC','PDM');
    
//    foreach($department as $department){
 
//         $sql ="SELECT Token FROM notify_token WHERE Department = '$department'";
//         $query = mysqli_query($n->con_db(),$sql);
//         $token=$query->fetch_array();
//         $array[] =$token['Token'];
//     }
    
    
//     // print_r($array);
//     // $date=date_create("2019-09-17");
//     // echo date_format($date,"Y/m/D");
//     // $day = "monday";
//     // echo substr($day,0,3); 
   
//     $logdata = $n->Log_notify("notify_daily");

 

//     print_r (explode(",",$logdata['Group_Post']));
    
?>