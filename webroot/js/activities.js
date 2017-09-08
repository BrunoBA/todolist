

	// METODO RESPONSÁVEL POR ADICIONAR NOVAS ATIVIDADES
	$(".addActivity").click(function()
	{			
		var name = $("#addActivity").val();
		$.post(
			'/activities/add',
			{nome:name},
			function(resposta){	
				
				if(resposta != ''){
					$("#concat").append(resposta);
					
					var total = $("#total").text();
					var total = $("#total").text(parseInt(++total));
				}
				
				$("#addActivity").val('');
				$("#addActivity").focus();

			},"html"
		);
	});

	// MÉTODO RESPONSÁVEL POR REMOVER ATIVIDADES
	$(document).on('click', '.rmActivity',function()
	{	
		fechar_inputs();		
		var id = $(this).attr('id');
		if(confirm("Tem certeza que deseja excluir esta atividade?")){
			$.post(
				'/activities/delete',
				{id:id},
				function(resposta){
					if(resposta.status == 'success'){

						$("#tr-"+id).css('display','none');

						var total = $("#total").text();
						var total = $("#total").text(parseInt(--total));

						if(resposta.concluido == 1){
							var concluded = $("#concluded").text();
							var concluded = $("#concluded").text(parseInt(--concluded));
						}
					}else{
						// alert(resposta.message);
						alertMessage(resposta.status,resposta.message);
					}
					
				},"json"
			);
		}
	});

	// MÉTODO RESPONSÁVEL POR CONCLUIR ATIVIDADS
	$(document).on('change', '.doActivity',function()
	{		
		fechar_inputs();		
		var id = $(this).attr('id');
		// if(confirm("Tem certeza que deseja concluir esta atividade?")){
			$.post(
				'/activities/concluir',
				{id:id},
				function(resposta){
					if(resposta.status == 'success'){
						
						var total = $("#concluded").text();
						if(resposta.type){
							var total = $("#concluded").text(parseInt(++total));
						}else{
							var total = $("#concluded").text(parseInt(--total));
						}
					}
					// alert(resposta.message);
					alertMessage(resposta.status,resposta.message);
				},"json"
			);
		// }
	});

	//MÉTODO RESPONSÁVEL POR ABRIR O INPUT PARA ALTERAR A ATIVIDADE 
	$(document).on('click', '.spans',function()
	{
		fechar_inputs();

		var id = $(this).attr('id');
		var idText = id.replace('span-','');

		$(this).css('display','none');

		$("#text-"+id).css('display','block');
		$("#text-"+idText).focus();
	})

	//MÉTODO RESPONSÁVEL POR EFETUAR A ALTERAÇÃO DOS DADOS 
	$(document).on('click', '.change',function()
	{

		var text = $(this).parent();

		// Valor do input hidden
		var idText = text.attr('id');

		var idText = $("#"+idText).attr('id').replace('span-','');
		
		// Novo nome para edição
		var name = $("#"+idText).val();

		// Id da atividade em questão
		var id = $("#"+idText).attr('id').replace('text-','');

		$.post(
			'/activities/edit',
			{ 
				id:id,
				name:name,
			},
			function(resposta){

				if(resposta.status == 'success'){
					$("#span-"+id).text(name);
				}else{
					console.log("#text-"+id);
					$("#text-"+id).val(name);
				}
				fechar_inputs();
				// alert(resposta.message);
				alertMessage(resposta.status,resposta.message);
			},"json"
		);
	});

	function fechar_inputs()
	{

		$(".spans").each(function(){
			var atividade = $(this).text().trim();
			var id = $(this).attr('id').replace('span-','');

			$("#text-"+id).val(atividade);
		});

		$(".div-input").css("display","none");
		$(".spans").css("display","block");
	}

	function alertMessage(status, message)
	{
		if(status == "success"){
			$(".alert-success").text(message);
			$(".alert-success").fadeIn();
			$(".alert-success").fadeOut(3000);
		}else{
			$(".alert-danger").text(message);
			$(".alert-danger").fadeIn();
			$(".alert-danger").fadeOut(3000);
		}
	}



