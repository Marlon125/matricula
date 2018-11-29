	function verEdicion(evento){
		var id = parseInt($("#idcreditoBuq").val());
		console.log(id);
		if( id !== 0){
			$.get('verEdicion',
					{idcredito: id},
					setEdicion,
					'json'
					);
		}else{
			alert("Debe seleccionar un registro");
			evento.stopPropagation();
		}
	}

	function setEdicion (datos) {
		console.log(datos);
		console.log("ajsdasdads");

		if(datos['error'] === 0){
			$("#idcredito").val(datos['idcredito']);
			$("#numero").val(datos['numero']);
			$("#btnGuardar").removeAttr('disabled');
		}else{
			alert('Ha ocurrido un erro en el sistema \n\nComuniquese con el administrador')
		}
	}

	function verEliminacion(evento){
		var id = parseInt($("#idCreditoBusq").val());
		if(id !== 0){
			$.get('verEliminacion',
				{idcredito: id},
				setEliminacion,
				'json');
		}else{
			alert("Debe seleccionar un registro");
			evento.stopPropagation();
		}
	}

	function setEliminacion(datos){
		if(datos['error'] === 0){
			$("#idcredito1").val(datos['idcredito']);
			$("#btnEliminar").removeAttr('disabled');
		}else{
			alert('Ha ocurrido un erro en el sistema \n\nComuniquese con el administrador')
		}
	}