<?php 
    $conn = new mysqli("localhost", "root", "", "chat");

    $received_data = json_decode(file_get_contents("php://input"));
    $data = array();

    if($received_data->action == 'sendMessage'){
        $data = array(
            'name' => $received_data->name,
            'output' => $received_data->message
        );

        $sqlQuery = "insert into tbl_messages(name, message)
                    values('". $data['name'] ."', '". $data['output'] ."')";
        $conn->query($sqlQuery);  
        $data['error'] = $conn->error;
        echo json_encode($data); 
    }elseif ($received_data->action == 'fethMessage') {
        $sqlQuery = "select * from tbl_messages order by created_at desc limit 10";
        $result = $conn->query($sqlQuery);
            while ($row = $result->fetch_assoc()) {
             $data[] = $row;
        }
        echo json_encode($data);
    }


?>