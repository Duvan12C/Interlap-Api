<?php 

require_once('../newConnectionDB.php');

$orderId = $_GET['orderId'];

$json = file_get_contents('php://input');

$dataBody = json_decode($json);


if($orderId != ""){

    $createdDate = date("Y-m-d");

    $examenes = array();
    $examenes = $dataBody;
    $examenesnum = count($examenes);

    for($i=0;$i<$examenesnum;$i++){
        
        $examId = $examenes[$i]->id;
        $result = $examenes[$i]->resultado;
        $gbValue = $examenes[$i]->gbData;
        $grValue = $examenes[$i]->grData;
        $netru = $examenes[$i]->neutrofilos;
        $hemo = $examenes[$i]->hemoglobina;
        $platelets = $examenes[$i]->plaquetas;

        mysqli_query($conn,"update laboratorio set resultado='$result',valores='',gb='$gbValue',gr='$grValue',neutrofilos='$netru',hemoglobina='$hemo',plaquetas='$platelets',ht='',vcm='',mch='',mchc='',bandas='',linfocitos='',monocitos='',eosinofilos='',basofilos='',mvp='',rdw_cv='',rdw_sd='',granulocitos='',celulas_medias='',pdw='',pct='',linfocitos2='' where id='$examId'");
    }

    $arr = array('success' => true, 'message' => "Order updated successfully total exams '$examenesnum' in order '$orderId'");
    echo json_encode($arr);

}else{

    $arr = array('success' => false, 'message' => "Order not found");
    echo json_encode($arr);

}

$conn->close();
?>
