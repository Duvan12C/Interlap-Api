<?php
    require_once('conexion.php');

    function unresmas($queryfull){
        $estaquery = $queryfull;
        while($esteresultado = mysqli_fetch_array($estaquery)){
            $resultado = $esteresultado[0];
        }
        return $resultado;
    }

    $sql = "(SELECT * FROM cotizar WHERE id = (SELECT MAX(id) FROM cotizar))";
    $sql2 = mysqli_query($conx,$sql);
    while ($datos = mysqli_fetch_array($sql2)) {
        $id_cotizar = $datos['id'];
        $cirugia = $datos['cirugia'];
        $tipo = $datos['tipo_cirugia'];
        $paquete = $datos['paquete'];
        $tiempo = $datos['tiempo'];
        $dias = $datos['dias'];
        $anestesia = $datos['anestesia'];
        $edad = $datos['edad'];
        $area = $datos['area_utilizar'];
        $monto = $datos['monto'];
        $esteusuario = $datos['usuario'];
        $equipo_coagulacion = $datos['equipo_coagulacion'];
        $otro_equipo = $datos['otro_equipo'];
        $enfermedades = $datos['enfermedades'];
        $info = $datos['info'];
    }

    $medico1 = unresmas(mysqli_query($conx, "select count(id) from medicos where login='$esteusuario'"),0);

    if($medico1 < 1){
        if(($tiempo == "Mas de 8 horas") || ($dias == "Mas de 5 dias") || ($tiempo == "Mas de 8 horas" && $dias == "Mas de 5 dias")){
            $estemedico = unresmas(mysqli_query($conx,"select concat_ws(' ',  NULLIF(nombre, ''),  NULLIF(apellido, '')) as nombremedico from usuarios where login='$esteusuario'"),0);

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
                    $prueba = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('insumo','medicamento')");
                    while ($datos_table = mysqli_fetch_array($prueba)) { 
            $otros2 = $otros2.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio = $datos_table['precio'];
                        $cantidad = $datos_table['cantidad'];
                        $id_insumo = $datos_table['id'];
                        $nom_insumo = $datos_table['nombre'];
                        $idinsumo = $datos_table['codigo'];
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
            //-----------------------------------------------------------------------------------------------------

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
                    $prueba_a = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('examen')");
                    while ($datos_table_a = mysqli_fetch_array($prueba_a)) { 
            $otros3 = $otros3.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio_a = $datos_table_a['precio'];
                        $cantidad_a = $datos_table_a['cantidad'];
                        $id_insumo_a = $datos_table_a['id'];
                        $nom_insumo_a = $datos_table_a['nombre'];
                        $idinsumo_a = $datos_table_a['codigo'];
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

            $mensaje = <<<MEN
            <font face='arial'>
            Estimado <b>Dr./Dra. $estemedico</b><br /><br />
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
            Abordaje: $tipo<br />
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

            $to = "gerencia@intercirugia.com";
            $cc = "gerencia@intercirugia.com";
            //$to = "portillojorge@gmail.com";
            $subject = "Solicitud de Cotizacion enviada";
            $from = "Interlap <webmaster@intercirugia.com>";
            $mailsend = mail("$to","$subject","$mensaje","From:$from\r\nReply-To:$to\r\nCc:$cc\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8");
        }else{
            $estemedico = unresmas(mysqli_query($conx,"select concat_ws(' ',  NULLIF(nombre, ''),  NULLIF(apellido, '')) as nombremedico from usuarios where login='$esteusuario'"),0);

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
                    $prueba = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('insumo','medicamento')");
                    while ($datos_table = mysqli_fetch_array($prueba)) { 
            $otros2 = $otros2.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio = $datos_table['precio'];
                        $cantidad = $datos_table['cantidad'];
                        $id_insumo = $datos_table['id'];
                        $nom_insumo = $datos_table['nombre'];
                        $idinsumo = $datos_table['codigo'];
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
            //-----------------------------------------------------------------------------------------------------

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
                    $prueba_a = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('examen')");
                    while ($datos_table_a = mysqli_fetch_array($prueba_a)) { 
            $otros3 = $otros3.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio_a = $datos_table_a['precio'];
                        $cantidad_a = $datos_table_a['cantidad'];
                        $id_insumo_a = $datos_table_a['id'];
                        $nom_insumo_a = $datos_table_a['nombre'];
                        $idinsumo_a = $datos_table_a['codigo'];
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

            $mensaje = <<<MEN
            <font face='arial'>
            Estimado <b>Dr./Dra. $estemedico</b><br /><br />
            Agradecemos la confianza en nuestro equipo de trabajo, será un honor darle la mejor atención médica a su paciente, con la calidad y calidez humana que nos caracteriza.<br />
            Hemos hecho un cálculo automático en nuestro sistema sobre los costos estimados de su cirugía, y lo detallamos a continuación.<br /><br />
            Nombre de la Cirugia: $cirugia<br />
            Codigo de Solicitud: $id_cotizar<br />
            Presupuesto Estimado: Desde $$monto dólares de los Estados Unidos.<br />
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

            $to = "gerencia@intercirugia.com";
            $cc = "gerencia@intercirugia.com";
            //$to = "portillojorge@gmail.com";
            $subject = "Solicitud de Cotizacion enviada";
            $from = "Interlap <webmaster@intercirugia.com>";
            $mailsend = mail("$to","$subject","$mensaje","From:$from\r\nReply-To:$to\r\nCc:$cc\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8");
        }
    }else{
        if(($tiempo == "Mas de 8 horas") || ($dias == "Mas de 5 dias") || ($tiempo == "Mas de 8 horas" && $dias == "Mas de 5 dias")){
            $correo = "select * from medicos where login='$esteusuario'";
            $correo2 = mysqli_query($conx,$correo);
            $data = mysqli_fetch_array($correo2);
            $email_medico = $data['email'];
            $nombre_medico = $data['nombre'];

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
                    $prueba = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('insumo','medicamento')");
                    while ($datos_table = mysqli_fetch_array($prueba)) { 
            $otros2 = $otros2.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio = $datos_table['precio'];
                        $cantidad = $datos_table['cantidad'];
                        $id_insumo = $datos_table['id'];
                        $nom_insumo = $datos_table['nombre'];
                        $idinsumo = $datos_table['codigo'];
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
            //-----------------------------------------------------------------------------------------------------

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
                    $prueba_a = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('examen')");
                    while ($datos_table_a = mysqli_fetch_array($prueba_a)) { 
            $otros3 = $otros3.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio_a = $datos_table_a['precio'];
                        $cantidad_a = $datos_table_a['cantidad'];
                        $id_insumo_a = $datos_table_a['id'];
                        $nom_insumo_a = $datos_table_a['nombre'];
                        $idinsumo_a = $datos_table_a['codigo'];
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

            $to = $email_medico;
            $cc = "gerencia@intercirugia.com";
            //$to = "portillojorge@gmail.com";
            $subject = "Solicitud de Cotizacion enviada";
            $from = "Interlap <webmaster@intercirugia.com>";
            $mailsend = mail("$to","$subject","$mensaje","From:$from\r\nReply-To:$to\r\nCc:$cc\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8");
        }else{
            $correo = "select * from medicos where login='$esteusuario'";
            $correo2 = mysqli_query($conx,$correo);
            $data = mysqli_fetch_array($correo2);
            $email_medico = $data['email'];
            $nombre_medico = $data['nombre'];

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
                    $prueba = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('insumo','medicamento')");
                    while ($datos_table = mysqli_fetch_array($prueba)) { 
            $otros2 = $otros2.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio = $datos_table['precio'];
                        $cantidad = $datos_table['cantidad'];
                        $id_insumo = $datos_table['id'];
                        $nom_insumo = $datos_table['nombre'];
                        $idinsumo = $datos_table['codigo'];
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
            //-----------------------------------------------------------------------------------------------------

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
                    $prueba_a = mysqli_query($conx,"select * from cotizar_insumos where id_cotizar='$id_cotizar' and tipo in ('examen')");
                    while ($datos_table_a = mysqli_fetch_array($prueba_a)) { 
            $otros3 = $otros3.<<<TABLA2
                    <tr>
            TABLA2;
                        $precio_a = $datos_table_a['precio'];
                        $cantidad_a = $datos_table_a['cantidad'];
                        $id_insumo_a = $datos_table_a['id'];
                        $nom_insumo_a = $datos_table_a['nombre'];
                        $idinsumo_a = $datos_table_a['codigo'];
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

            $mensaje = <<<MEN
            <font face='arial'>
            Estimado <b>Dr./Dra. $nombre_medico</b><br /><br />
            Agradecemos la confianza en nuestro equipo de trabajo, será un honor darle la mejor atención médica a su paciente, con la calidad y calidez humana que nos caracteriza.<br />
            Hemos hecho un cálculo automático en nuestro sistema sobre los costos estimados de su cirugía, y lo detallamos a continuación.<br /><br />
            Nombre de la Cirugia: $cirugia<br />
            Codigo de Solicitud: $id_cotizar<br />
            Presupuesto Estimado: Desde $$monto dólares de los Estados Unidos.<br />
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

            $to = $email_medico;
            $cc = "gerencia@intercirugia.com";
            //$to = "portillojorge@gmail.com";
            $subject = "Solicitud de Cotizacion enviada";
            $from = "Interlap <webmaster@intercirugia.com>";
            $mailsend = mail("$to","$subject","$mensaje","From:$from\r\nReply-To:$to\r\nCc:$cc\r\nMIME-Version: 1.0\r\nContent-type: text/html; charset=utf-8");
        }
    }

?>