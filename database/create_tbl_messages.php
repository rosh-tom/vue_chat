<?php  
    $conn = new mysqli("localhost", "root", "", "chat");
    $tablename = 'tbl_messages';
    $sqlQuery = "create table ". $tablename ."(
        id int(6) unsigned auto_increment primary key,  
        name varchar(50) not null,
        message varchar(255) not null, 
        created_at timestamp default current_timestamp,
        updated_at timestamp default current_timestamp on update current_timestamp
    )"; 
    if($conn->query($sqlQuery)){
        echo $tablename ." is successfully created. ";
    }else{
        echo "failed creating table (". $tablename .") Error: ". $conn->error;
    } 
    $conn->close(); 

?>