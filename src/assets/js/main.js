

let ajaxInLoad = false;
const evvGetUnitStatusService = ()=>{
	if(!ajaxInLoad){
		
		console.log("evvGetUnitStatusService: called");

		ajaxInLoad=true;
		let data = new FormData(document.form_empre);
	    	data.set('ac','unidadesGetStatus');
	    const oReq = new XMLHttpRequest();
			oReq.onload = function(){
				const retorno = Util.isJson(this.responseText);
				if (retorno!==false) {
					retornoObj = JSON.parse(this.responseText);
					console.log(retornoObj);
					updateUnitPointsStatus(retornoObj.resource);
				}
				ajaxInLoad=false;
			};
			oReq.error = function(){
				console.log('Erro ao processar requisição. Verificar conexão com a internet');
				ajaxInLoad=false;
			};
			oReq.open("post","/site/direct-includes/modulo-espelho-vendas-ajax-controller.php");
			oReq.send(data);
	}
}
if ($('#planta_container').length>0){
	setInterval(evvGetUnitStatusService,10000);
}

const evvSetViewStatus = (statusView)=>{
	console.log(statusView);
	$('polygon.situacao').removeClass('white_hightlight');
	$('polygon.situacao').addClass('hideme');
	$('polygon.sit_'+statusView).removeClass('hideme');
	if (statusView==='all'){
		$('polygon.situacao').removeClass('hideme');	
	}
	if (statusView==='livre'){
		$('polygon.situacao').removeClass('hideme');
		$('polygon.situacao').addClass('white_hightlight');
		$('polygon.sit_'+statusView).removeClass('white_hightlight');
	}
}

	//livre
	//hipoteca
	//reserva_cliente
	//reserva_tecnica
	//indisponivel
	//vendido
	//hipotecado_vendido
	//cliente_parceiro


let updateing = false;
const updateUnitPointsStatus = (unidades)=>{
	if (!updateing){
		updateing=true;
		unidadesPoints = document.getElementById('unidadesPoints');
		if(typeof unidades == 'object'){
			
			unidades.forEach((element)=>{
				
				let unidadeItem = document.getElementById("un"+element.unidade_idx);
				
				let situacaoVenda = element.situacao_venda;
				let situacaoVendaCor = '';
				eval("situacaoVendaCor = statusCores."+situacaoVenda+";");
				
				console.log("situacaoVendaCor: "+situacaoVendaCor);
				
				unidadeItem.setAttribute("fill",situacaoVendaCor);
				$(unidadeItem).removeClass("sit_livre sit_reserva_cliente sit_vendido");
				$(unidadeItem).addClass('sit_'+situacaoVenda);
				// unidadeItem.setAttribute("class",'situacao sit_'+situacaoVenda);
				// unidadeItem.className = 'situacao sit_'+situacaoVenda;

				

			});
			updateing=false;
		}
	}
}







