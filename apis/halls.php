<?php

use function PHPSTORM_META\type;

require '../conn.php';

$hall_id=@$_POST['hall_id'];
$desc=@$_POST['hdesc'];
$type=@$_POST['htype'];
$capacity=@$_POST['hcapacity'];
$location=@$_POST["hlocation"];
$photo=@$_FILES['hphoto']['name'];
$path=@$_FILES['hphoto']['tmp_name'];
$mdate= date ('y-m-d');
$folder ="../images/".$photo;

if(empty($hall_id)){    
    if (empty($desc) && empty($type)){

    }   
    else{

$sql="insert into halls values (null,'$type','$location','$capacity','$folder','$desc','$mdate')";
$query=mysqli_query($conn,$sql);
if($query){
    move_uploaded_file($path,$folder);
    $result = [
        'message'=>'successfully inserted a new row',
         'status'=>200
        ];
    echo json_encode($result);
    return ;
}
else{

    $result = [
    'message'=>'Could Not Create new Hall', 
    'status'=>404
];
    echo json_encode($result);
    return ;
}
}
}
else{   
 $sql="update halls set hall_type='$type',location='$location',capacity='$capacity',hall_photo='$folder',hall_desc='$desc',date='$mdate' where hall_id='$hall_id' ";
    $query=mysqli_query($conn,$sql);
    
    if($query){
        move_uploaded_file($path,$folder);
        $result = [
            'message'=>'successfully Updated a new row',
             'status'=>200
            ];
        echo json_encode($result);
        return ;
    }
    else{
    
        $result = [
        'message'=>'Could Not Updated', 
        'status'=>404
    ];
        echo json_encode($result);
        return ;
    }
    }
    
    if (isset($_POST['hallid'])) {
                
        $id = $_POST['hallid'];
        $id = mysqli_real_escape_string($conn, $id);
    $sql = "SELECT hall_id,hall_type,location,capacity,hall_photo,hall_desc FROM halls WHERE hall_id= '$id'";
        $result = mysqli_query($conn, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            $hallData = [
                'hid' => $row['hall_id'],
                'htype' => $row['hall_type'],
                'hlocation' => $row['location'],
                'hcapacity' => $row['capacity'],
                'hdesc' => $row['hall_desc'],
                'hphoto' => $row['hall_photo']
            ];
            echo json_encode($hallData);
        } else {
            echo json_encode(['error' => 'hall not found']);
        }
    }

            
                    
              
            
            
