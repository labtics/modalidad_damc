<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Requerimientos de Titulación</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">
</head>
<body>
	 <center> <img src="img/modalidad2.jpg" alt=""></center>
	 
    <h2>Requerimientos de Titulación</h2>
	
    <div id="datos">
	
             <table>
				<thead>
					<tr>
						<th>Matrícula</th>
						<th>Licenciatura</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Modalidad</th>
						<th>Fecha</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{$user[0]->matricula}}</td>
						<td>{{$licenciatura}}</td>
						<td>{{strtoupper($user[0]->nombre)}}</td>
						<td>{{strtoupper($user[0]->apellidos)}}</td>
						<td>{{$user[0]->modalidad}}</td>
						<td>{{$user[0]->created_at}}</td>
					</tr>
				</tbody>
			</table>

            @if($modalidad == 1)
                
			<ol>
					<li>Formato de oficio de solicitud de modalidad de titulación (copia).</li>
					<li>Oficio de autorización de modalidad de titulación (original).</li>
					<li>Oficio y recibo de no adeudo de material bibliográfico (original) costo $Checar en área respectiva.</li>
					<li>Recibo de no adeudo de material de laboratorio (original) costo $Checar en área respectiva.</li>
					<li>Recibo y oficio expedido por el  Centro de cómputo (original) costo $Checar en área respectiva.</li>
					<li>Constancias de acreditación de Servicio Social (copia y original para cotejo).</li>
					<li>Revisión de estudios (original).</li>
					<li>Certificado de estudios de Licenciatura (copia y original para cotejo).</li>
					<li>Clave única del registro de población (CURP)</li>
					<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
					<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
					<li>Certificado parcial o total de estudios de maestría (original y copia). NOTA: Debera especificar el porcentaje de créditos cursados 40%</li>
					<li>Dictamen de registro de la Maestría ante la Dirección General de Profesiones de la S.E.P. (copia).</li>
					<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
					<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
					<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol>
            
			@elseif($modalidad== 2)

			<ol>
				<li>Formato de oficio de solicitud de modalidad de titulación (copia).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Oficio y recibo de no adeudo de material bibliográfico (original) costo $Checar en área respectiva.</li>
				<li>Recibo de no adeudo de material de laboratorio (original) costo $Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) costo $Checar en área respectiva.</li>
				<li>Constancias de acreditación de Servicio Social (copia y original para cotejo).</li>
				<li>Revisión de estudios (original).</li>
				<li>Certificado de estudios de Licenciatura (copia y original para cotejo).</li>
				<li>Clave única del registro de población (CURP)</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
				<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
				<li>Certificado parcial o total de estudios de maestría (original y copia). NOTA: Debera especificar el porcentaje de créditos cursados 40%</li>
				<li>Dictamen de registro de la Maestría ante la Dirección General de Profesiones de la S.E.P. (copia).</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol>

			@elseif($modalidad== 3)
			<ol>
				<li>Formato de oficio de solicitud de modalidad de titulación (original).</li>
		    	<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original)  costo $Checar en área respectiva.</li>
				<li>Recibo de no adeudo de material de laboratorio (original) costo $ Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) costo $ Checar en área respectiva.</li>
				<li>Constancias de acreditación de servicio social (copia y original).</li>
				<li>Revisión de estudios (original).</li>
				<li>Certificado de estudios de Licenciatura  (copia y original).</li>
				<li>Clave única del registro de población (CURP).</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
				<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol>    
			@elseif($modalidad== 4)
			<ol>
				<li>Formato de oficio de solicitud de modalidad de titulación (original).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original)  costo $Checar en área respectiva.</li>
				<li>Oficio de no adeudo de material de laboratorio (original) costo $Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) costo $Checar en área respectiva.</li>
				<li>Constancias de acreditación de servicio social (original y copia).</li>
				<li>Revisión de estudios (original).</li>
				<li>Certificado de estudios de Licenciatura   (Original y copia).</li>
				<li>Clave única del registro de población (CURP).</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
				<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
				<li>Constancias de puntuación y resultado obtenido (original y copias, sello y firma de Dirección).</li>
				<li>Constancia de desempeño y satisfactorio o sobresaliente (original y copia, sello y firma de Dirección).</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol>   
			@elseif($modalidad== 5)
			<ol>
				<li>Formato de oficio de solicitud de modalidad de titulación (copia).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original) $costo $Checar en área respectiva.</li>
				<li>Recibo de no adeudo de material de laboratorio (original) costo $Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) $Checar en área respectiva.</li>
				<li>Constancias de acreditación de servicio social (copia y original para cotejo).</li>
				<li>Revisión de estudios (original).</li>
				<li>Certificado de estudios de Licenciatura   (copia y original para cotejo).</li>
				<li>Clave única del registro de población (CURP) (copia al 200%).</li>
				<li>Copia de la portada del reporte escrito del caso práctico con firma y sello de la Dirección.</li>
				<li>Original y copia del Certificado de Bachillerato.</li>
				<li>Hoja impresa de datos actualizados del Sistema de Servicios Escolares (SEL) Vigencia NO mayor a 15 días.</li>
			</ol>   
			@elseif($modalidad== 6)
			<ol>
				<li>Formato de oficio de solicitud de modalidad de titulación (original).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original) costo $Checar en área respectiva.</li>
				<li>Oficio de no adeudo de material de laboratorio (original)  costo $Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) $Checar en área respectiva.</li>
				<li>Constancias de acreditación de servicio social (copia y original para cotejo).</li>
				<li>Revisión de estudios (original).</li>
				<li>Certificado de estudios de Licenciatura (copia y original para cotejo).</li>
				<li>Clave única del registro de población (CURP)</li>
				<li>Constancia de Buena Conducta (original).</li>
				<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol>   
			@elseif($modalidad== 7)
			<ol>
				<li>Formato de solicitud de modalidad de titulación (orignal).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original) costo Checar en área respectiva.</li>
				<li>Recibo de no adeudo de material de laboratorio (original) costo Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el  Centro de cómputo (original) costo $Checar en área respectiva.</li>
				<li>Constancias de acreditación de Servicio Social (copia y original para cotejo). </li>
				<li>Revisión de estudios (original). </li>
				<li>Certificado de estudios de Licenciatura   (copia y original para cotejo).</li>
				<li>Clave única del registro de población (CURP)</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, este deberían incluir constancia de autencidad.</li>
				<li>Acta de Nacimiento (original y copia con vigencia no mayor a 2 años).</li>
				<li>Oficio de autorización de impresión del trabajo recepcional (original).</li>
				<li>Portada del trabajo recepcional (copia).</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-)</li>
			</ol>   
			@elseif($modalidad== 8)
			<ol>
				<li>Formato de solicitud de modalidad de titulación (original).</li>
				<li>Oficio de autorización de modalidad de titulación (original).</li>
				<li>Recibo y oficio de no adeudo de material bibliográfico (original) costo Checar en área respectiva.</li>
				<li>Oficio de no adeudo de material de laboratorio (original) costo Checar en área respectiva.</li>
				<li>Recibo y oficio expedido por el Centro de cómputo (original) costo $Checar en área respectiva</li>
				<li>Constancias de acreditación de servicio social (copia y original para cotejo). </li>
				<li>Revisión de estudios (original). </li>
				<li>Certificado de estudios de Licenciatura   (copia y original para cotejo).</li>
				<li>Clave única del registro de población (CURP)</li>
				<li>Certificado de estudios de Bachillerato (original y copia). Si el certificado es del 2010 o años anteriores, a este deberían incluir constancia de autencidad.</li>
				<li>Acta de nacimiento (original y copia, con vigencia no mayor a dos años).</li>
				<li>Oficio de autorización de impresión del trabajo recepcional (original).</li>
				<li>Portada del trabajo recepcional (estado del arte, copia).</li>
				<li>Carta de aceptación del artículo publicado (copia).</li>
				<li>Portada de la Revista en donde se publicó el articulo (copia)</li>
				<li>Extenso del Artículo (copia)</li>
				<li>Actualización de datos del Sistema de Servicios Escolares (sel.ujat.mx). Vigencia no mayor a 15 días (orginal firmada)</li>
				<li>Constancia liberada de las Actividades Académicas Extracurriculares (copia).</li>
				<li>Fotos tamaño credencial ovaladas aderibles (Médico Cirujano -Núm 4- Rehabilitación Física, Enfermería y Atención Prehospitalaria y Desastre -Núm 3-).</li>
			</ol> 
            @endif


			<p>N O T A: <br>
	 					Deberán entregar los documentos en una caperta tamaño oficio (originales y copias) y una carpeta tamaño carta color beige con copias del expediente, etiquetadas con nombre, licenciatura y matrícula.
			</p>   
                        
			<br>
			<center> 
				___________________________<br>  
				Firma 
				Egresado {{$user[0]->num}}

			
			</center>
			
    </div>
</body>
</html>