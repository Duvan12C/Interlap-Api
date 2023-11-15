<?php
    require_once "home1/bariatr5/php/Mail.php";
    require_once "home1/bariatr5/php/Mail/mime.php";
    require_once('../newConnectionDB.php');

    $sql = "(SELECT * FROM cotizar WHERE id = (SELECT MAX(id) FROM cotizar))";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    
        $cirugia = $row['cirugia'];
        $id_cotizar = $row['id'];
        $paquete = $row['paquete'];
        $area = $row['area_utilizar'];
        $tiempo = $row['tiempo'];
        $dias = $row['dias'];
        $anestesia = $row['anestesia'];
        $tipo_cirugia = $row['tipo_cirugia'];
        $equipo_coagulacion = $row['equipo_coagulacion'];
        $otro_equipo = $row['otro_equipo'];
        $edad = $row['edad'];
        $enfermedades = $row['enfermedades'];
        $info = $row['info'];
        $nombre_medico = $row['usuario'];
    
        $result->free();
    } else {
        // No se encontraron resultados
    }
    

    $from = "Interlap <webmaster@intercirugia.com>";
    $to = "Lidia Pineda <gerencia@intercirugia.com>";
    $subject = "Solicitud de Cotizacion enviada";
    $text = "Hi, It is a text message";
    $html = "It is a HTML message";
    $mime = new Mail_mime();

    $otros2 = <<<TABLA
            <font face='arial'>
                <table style='border: solid 1px #0387d1; width: 600px;'>
                    <tr>
                        <th colspan='3' style='color: #ffffff; font-size:14px; background-color:#0176b5;'>
                            Antibioticos, Medicamentos o Insumos especiales requeridos
                        </th>
                    </tr>
                    <tr>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Cant</td>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Código</td>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Nombre</td>
                    </tr>
    TABLA;
                    $sql2 = "(SELECT * FROM cotizar_insumos WHERE id_cotizar='$id_cotizar' and tipo in ('insumo','medicamento'))";
                    $result2 = $conn->query($sql2);
                    while ($row2 = $result2->fetch_assoc()) { 
    $otros2 = $otros2.<<<TABLA2
                    <tr>
    TABLA2;
                        $precio = $row2['precio'];
                        $cantidad = $row2['cantidad'];
                        $id_insumo = $row2['id'];
                        $nom_insumo = $row2['nombre'];
                        $idinsumo = $row2['codigo'];
                        $total = $precio * $cantidad;

    $otros2 = $otros2.<<<TABLA3
                        <td style='background-color:#95d8fb;'>$cantidad</td>
                        <td style='background-color:#95d8fb;'>$idinsumo</td>
                        <td style='background-color:#95d8fb;'>$nom_insumo</td>

                    </tr>
    TABLA3;		
                    }
    $otros2 = $otros2.<<<TABLA4
                </table>
            </font>
    TABLA4;

    //-------------------------------------------------------------------------------------------------------------------------------

    $otros3 = <<<TABLA
            <font face='arial'>
                <table style='border: solid 1px #0387d1; width: 600px;'>
                    <tr>
                        <th colspan='3' style='color: #ffffff; font-size:14px; background-color:#0176b5;'>
                            Hemoderivados y Exámenes
                        </th>
                    </tr>
                    <tr>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Cant</td>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Código</td>
                        <td style='color: #ffffff; font-size:14px; background-color:#0176b5;'>Nombre</td>
                    </tr>
    TABLA;
                    $sql3 = "(SELECT * FROM cotizar_insumos WHERE id_cotizar='$id_cotizar' and tipo in ('examen'))";
                    $result3 = $conn->query($sql3);
                    while ($row3 = $result3->fetch_assoc()) { 
    $otros3 = $otros3.<<<TABLA2
                    <tr>
    TABLA2;
                        $precio_a = $row3['precio'];
                        $cantidad_a = $row3['cantidad'];
                        $id_insumo_a = $row3['id'];
                        $nom_insumo_a = $row3['nombre'];
                        $idinsumo_a = $row3['codigo'];
                        $total_a = $precio_a * $cantidad_a;

    $otros3 = $otros3.<<<TABLA3
                        <td style='background-color:#95d8fb;'>$cantidad_a</td>
                        <td style='background-color:#95d8fb;'>$idinsumo_a</td>
                        <td style='background-color:#95d8fb;'>$nom_insumo_a</td>

                    </tr>
    TABLA3;		
                    }
    $otros3 = $otros3.<<<TABLA4
                </table>
            </font>
    TABLA4;

    //-------------------------------------------------------------------------------------------------------------------------------

    $mensaje = <<<MEN
        <font face='arial'>
            Estimado <b>Dr./Dra. $nombre_medico</b><br /><br />
            Agradecemos la confianza en nuestro equipo de trabajo, será un honor darle la mejor atención médica a su paciente, con la calidad y calidez humana que nos caracteriza.<br />
            Hemos hecho un cálculo automático en nuestro sistema sobre los costos estimados de su cirugía, y lo detallamos a continuación.<br /><br />
            Nombre de la Cirugia: $cirugia<br />
            Codigo de Solicitud: $id_cotizar<br />
            Presupuesto Estimado: El Presupuesto de su procedimiento, debe ser calculado por un ejecutivo de Atención al Médico, por favor ponerse en contacto al 2526-8100 o puede escribirnos al correo (gerencia@intercirugia.com).<br />
            Tipo de Servicio: $paquete<br />
            Área a Utilizar: $area<br />
            Duración de Procedimiento: $tiempo<br />
            Dias de estancia hospitalaria: $dias<br />
            Tipo de Anestesia: $anestesia<br />
            Abordaje: $tipo_cirugia<br />
            Equipo de Electrocirugía Requerido: $equipo_coagulacion<br />
            Otro Equipo Requerido: $otro_equipo<br />
            Edad del paciente: $edad años<br />
            Enfermedades que padece: $enfermedades<br />
            Agregar informacion: $info<br /><br />
            Medicamentos e Insumos Especiales requeridos:<br />
            <div align='center'>
                    $otros2
            </div>
            <br /><br />
            Hemoderivados y Exámenes:<br />
            <div align='center'>
                    $otros3
            </div>
            <br /><br />
            <p>Este presupuesto tiene una validez de 30 días, recuerde que los precios brindados son aproximados, puede haber reducción o incremento en el precio final. El
            costo total a cancelar solo se establece hasta después de haber brindado los servicios hospitalarios. Estos costos no incluyen honorarios médicos, gastos por
            procesamiento de biopsias, costos de exámenes de laboratorio o gabinete preoperatorios no detallados, costos de medicamentos o insumos especiales, a menos
            que sean detallados en la solicitud.</p><br />

            <p>Si el presupuesto anterior no satisface sus expectativas le ruego contactar directamente a la oficina de atención al médico, también puede escribir o llamar a la
            gerencia de la institución, con gusto haremos todo lo posible par ajustarnos a sus necesidades.</p><br />

            Reiteramos nuestros agradecimientos por su confianza.<br />
        </font>
    MEN;

    $mime->setHTMLBody($mensaje);
    //$mime->setTXTBody($text);
    $body = $mime->get();

    $host = "mail.smtp2go.com";
    $port = "2525"; // 8025, 587 and 25 can also be used.
    $username = "bariatricasv";
    $password = "Interlap202305";

    $headers = array ('From' => $from,
    'To' => $to,
    'Subject' => $subject);
    $headers = $mime->headers($headers);
    $smtp = Mail::factory('smtp',
    array ('host' => $host,
    'port' => $port,
    'auth' => true,
    'username' => $username,
    'password' => $password));

    $mail = $smtp->send($to, $headers, $body);

    if (PEAR::isError($mail)) {
        echo("
        " . $mail->getMessage() . "

        ");
        } else {
        echo("
        Message successfully sent!

        ");
    }
?>