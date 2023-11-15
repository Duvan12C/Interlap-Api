<?php 

require_once('../newConnectionDB.php');

$patientId = $_GET['patient'];
$doctor = $_GET['doctor'];
$user = $_GET['user'];

$json = file_get_contents('php://input');

$dataBody = json_decode($json);


if($patientId != ""){


$createdDate = date("Y-m-d");

$examenes = array();
$examenes = $dataBody;
$examenesnum = count($examenes);

$firstExamValue = $examenes[0]->id;


$sql = "select max(ordenid) from laboratorio2";
$getLastOrderResult = $conn->query($sql);

while ($row = $getLastOrderResult->fetch_assoc()) {
    $resinforden = $row['max(ordenid)'];
}

if ($resinforden == ""){
$ordenid = 1;
}else{
$ordenid = $resinforden+1;
}


// Agregar a laboratorio2
$insertOrderQuery = "insert into laboratorio2 (pid,ordenid,fecha,usuario,doctor) values ('$patientId','$ordenid','$createdDate','$user','$doctor')";
$insertOrderResult = $conn->query($insertOrderQuery);


//Agregar a laboratorio

for($i=0;$i<$examenesnum;$i++){
$esteexamen = $examenes[$i]->id;




if($esteexamen == "combo1"){
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteinas Sericas')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Albumina Serica')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','TSH')");
}else{

if($esteexamen == "combo2"){
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteinas Sericas')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Albumina Serica')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','TSH')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Oxalacetica-GOT/AST')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo parcial de Tromboplastina TPT')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo de Protrombina TP')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','I.N.R.')");
}else{


if($esteexamen == "combo3"){

mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemoglobina Glicosilada')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Baja Densidad-LDL')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','VLDL')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Alta Densidad-HDL')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteinas Sericas')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Albumina Serica')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','TSH')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Oxalacetica-GOT/AST')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo parcial de Tromboplastina TPT')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo de Protrombina TP')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','I.N.R.')");
//Examen General de Orina
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");

}else{

if($esteexamen == "combo4"){

mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urocultivo.')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Conteo de Colonias')");
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observacion')");

}else{

if($esteexamen == "PERFIL TOLERANCIA GLUCOSA"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Tolerancia Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ayuno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','60 MIN')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','120 MIN')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','180 MIN')");
        
}else{

if($esteexamen == "PERFIL ELECTROLITOS"){

    
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Electrolitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sodio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Potasio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Calcio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosforo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Magnesio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cloro')");
    
            
}else{

if($esteexamen == "FROTIS DE SANGRE PERIFERICA"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Frotis de Sangre Periferica')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Línea Roja')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Línea Blanca')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Neutrofilos maduros o segmentados')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Linfocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Monocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Eosinofilos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Basofilos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Celulas Inmaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Línea Plaquetaria')");
                
}else{
    
if($esteexamen == "Examen General de Orina"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
                    
}else{

if($esteexamen == "General de Heces"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");
                        
}else{

if($esteexamen == "PERFIL HEMATOLOGIA 1"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Hematologia 1')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LINEA ROJA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glóbulos Rojos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HGB')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','VCM')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MCH')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MCHC')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LINEA BLANCA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glóbulos Blancos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Neutrofilos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bandas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Linfocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Monocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Eosinófilos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Basófilos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LINEA PLAQUETARIA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Plaquetas.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MVP')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Frotis de sangre periférica')");
                            
}else{

if($esteexamen == "FROTIS/COLORACION DE GRAM"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Frotis/Coloración de Gram')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Muestra')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Resultado')");
                            
}else{

if($esteexamen == "PERFIL HEMOGRAMA COMPLETO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Hemograma Completo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LÍNEA ROJA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Globulos Rojos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HT.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HGB.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','VCM.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MCH.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MCHC.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','RDW-CV')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','RDW-SD')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LINEA BLANCA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Globulos Blancos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Granulocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Linfocitos:')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Celulas Medias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','RECUENTO MANUAL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Neutrofilos %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Linfocitos %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Monocitos %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Eosinofilos %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Basofilos %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Neutrofilos en banda %')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LINEA PLAQUETARIA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Plaquetas:')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','MVP.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PDW')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PCT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Frotis de sangre periférica.')");
                                
}else{

if($esteexamen == "PERFIL HEPATICO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Hepatico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosfatasa Alcalina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Gamma G.T.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas Tot. y Dif.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Oxalacetica-GOT/AST')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T.T.P.A.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T. y V. Protrombina')");
                                
}else{

if($esteexamen == "PERFIL TIROIDEO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Tiroideo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','TSH')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T3')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T4')");
                                    
}else{

if($esteexamen == "PERFIL CARDIACO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Cardiaco')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','CPK-MB')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','LDH (LACTATO DESHIDROGENASA)')");
                                        
}else{


if($esteexamen == "PERFIL DE COAGULACION"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil de Coagulacion')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Rec. Plaquetas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Retraccion del Coagulo en 24h.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo de Coagulacion')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T.T.P.A.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T. y V. Protrombina')");
                                            
}else{

if($esteexamen == "PERFIL ECONOMICO DE RUTINA"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
    //
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");

                                                
}else{

if($esteexamen == "PERFIL REUMATOIDEO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Reumatoideo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Células LE+ANA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Latex R.A.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucograma')");
    
                                                    
}else{

if($esteexamen == "PERFIL QUIMICO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Quimico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Calcio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosfatasa Alcalina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosforo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas Tot. y Dif.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Oxalacetica-GOT/AST')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
                                                        
}else{

if($esteexamen == "PERFIL DROGAS DE ABUSO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Drogas de Abuso')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Alcohol')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Anfetaminas/Metanfetaminas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Benzodiazepinas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cocaína')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Marihuana')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Opiáceos')");
                                                            
}else{

if($esteexamen == "PERFIL PRE-OPERATORIO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Pre-Operatorio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Grupo Sanguineo Rh')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hb. y Ht.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T.T.P.A.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T. y V. Protrombina')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
                                                                
}else{

if($esteexamen == "PERFIL FEBRIL"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Febril')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Antigenos Febriles')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Plasmoidum (Gota Gruesa)')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucograma')");
    //
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
                                                                
}else{

if($esteexamen == "PERFIL RENAL"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Renal')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Potasio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sodio')");
    //
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
                                                                
}else{

if($esteexamen == "PERFIL PRENATAL PARCIAL"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Prenatal Parcial')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Grupo Sanguineo Rh')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hb. y Ht.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','V.D.R.L.')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //Examen General de Heces
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");
                                                                
}else{

if($esteexamen == "PERFIL PRE-NATAL"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Pre-Natal')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Citomegalovirus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Grupo Sanguineo Rh')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','H.I.V.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Rubeola')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Toxoplasmosis')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','V.D.R.L.')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //Examen General de Heces
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");
                                                                
}else{

if($esteexamen == "PERFIL LIPIDOS TOTALES"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Lipidos Totales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Apoliproteínas A1-B1')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Alta Densidad-HDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Baja Densidad-LDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Alto CAD2-CAD3')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
                                                                
}else{

if($esteexamen == "PERFIL DE RUTINA"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil de Rutina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //Examen General de Heces
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");
                                                                
}else{

if($esteexamen == "PERFIL EJECUTIVO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Ejecutivo')");
    //Hemograma Completo
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    //Varios Examenes
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Alta Densidad-HDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Baja Densidad-LDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosfatasa Alcalina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosforo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sodio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Potasio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Calcio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteinas Tot. y Dif.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','V.D.R.L.')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //Examen General de Heces
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");           

}else{

if($esteexamen == "PERFIL HEMATOLOGICO"){

    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Reticulocitos')");
                                
}else{

if($esteexamen == "PERFIL COMPLETO"){
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Perfil Ejecutivo')");
    //Perfil Hemograma Completo
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hemograma')");
    //Varios
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Acido Urico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Alta Densidad-HDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Baja Densidad-LDL')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Colesterol Total')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Creatinina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosfatasa Alcalina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Fosforo')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sodio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Potasio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Calcio')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitrogeno Ureico')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas Tot. y Dif.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Transaminasa Piruvica-GPT /ALT')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Trigliceridos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','V.D.R.L.')");
    //Varios 2
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T3')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','T4')");
    //Examen General de Orina
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE ORINA')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN FISICO-QUIMICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Densidad')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Aspecto')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Ph')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Sangre/Hemoglobina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Esterasa Leucocitaria')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Nitritos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Proteínas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Glucosa.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cuerpos Cetonicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Urobilinogeno')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bilirrubina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN MICROSCOPICO')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematíes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos.')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Escamosas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cel. Epiteliales Redondas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cilindros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Cristales')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Bacterias')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Levaduras')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','HIFAS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Filamentos Mucoides')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Parasitos')");
    //Examen General de Heces
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','EXAMEN GENERAL DE HECES')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Consistencia')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Color')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Mucus')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','PROTOZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Activos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Quistes')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','METAZOARIOS')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Huevos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Larvas')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Otros')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Macroscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Restos Alimenticios Microscopicos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Leucocitos')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Hematies')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Observaciones')");
}else{

if($esteexamen == "Tiempo y Valor de Protrombina"){
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','Tiempo y Valor de Protrombina')");
    mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','I.N.R.')");
}else{


$firstExamValue = $examenes[$i]->name;
mysqli_query($conn,"insert into laboratorio (ordenid,examen) values ('$ordenid','$firstExamValue')");



}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}






}


$firstExamValue = $esteexamen->id;
$arr = array('success' => true, 'message' => "Order created with the number $ordenid");

echo json_encode($arr);


}else{

$firstExamValue = $esteexamen->id;
$arr = array('success' => false, 'message' => "Patient not found");

echo json_encode($arr);

}

$conn->close();

?>
