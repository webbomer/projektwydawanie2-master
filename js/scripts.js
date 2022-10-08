
// function load(){
// 	//document.getElementById("orderList").querySelectorAll('td').forEach(cell => {
//     document.querySelectorAll('td').forEach(cell => {
// 		cell.addEventListener('click', evt => {
// 			//var cellContent = cell.textContent;
//             console.log(cell.textContent);
// 		}); 
// 	})}

	var view = 1;
	var orderListZ = document.getElementById('orderList');
	var orderZ = document.getElementById('order');
	var viewOrderListZ = document.getElementById('viewOrderList');
	var viewOrderZ = document.getElementById('viewOrder');
	var floatButonOnViev =document.getElementById('fixed-action-btn-viev2');
	var UkryjSzukanie=document.getElementById('szukanieWTabeli');
	var Zzływyburzamówienia=document.getElementById('zływyburzamówienia');
	var divCalendaryWithSearch=document.getElementById('seachIconViev');
	var vievautoScan_AllInOneDIVonoff=document.getElementById('autoScan_AllInOneDIV');
	var divautoScan_AllInOne=document.getElementById('autoScan_AllInOne');
	var seachIcondd=document.getElementById('seachIcon');
var pokazUkryjZrobioneV=document.getElementById('pokazUkryjZrobione');
	function PokazUkryjTekst() {
	if ( view == 1) {
		prelouder(1);
		viewOrderListZ.style.display = 'none';
		orderListZ.style.display = 'none';
		UkryjSzukanie.style.display ='none';
		viewOrderZ.style.display = 'block';
		orderZ.style.display = 'table';
		floatButonOnViev.style.display = 'block';
		// UkryjSzukanie.style.display ='block';
		Zzływyburzamówienia.style.display = 'block';
		divautoScan_AllInOne.style.display = 'block';
		view=0;
		divCalendaryWithSearch.style.display = 'none';
		viewSzukajPoStanData=0;
		vievautoScan_AllInOneDIVonoff.style.display ='none';
		document.getElementById("autoScan_AllInOneDIVonoff").value=0;
		prelouder(2);
		seachIcondd.style.display='none';
		pokazUkryjZrobione.style.display='';

	} else if (view == 0) {
		searchIn(44,0);
		viewOrderListZ.style.display = 'block';
		orderListZ.style.display = 'table';
		UkryjSzukanie.style.display ='block';
		viewOrderZ.style.display = 'none';
		orderZ.style.display = 'none';
		floatButonOnViev.style.display ='none';
		// UkryjSzukanie.style.display ='none';
		Zzływyburzamówienia.style.display = 'none';
		divautoScan_AllInOne.style.display = 'none';
		vievautoScan_AllInOneDIVonoff.style.display ='none';
		document.getElementById("autoScan_AllInOneDIVonoff").value=0;
		seachIcondd.style.display='';
		pokazUkryjZrobione.style.display='none';
		view=1;
	};
};
function autoScan_AllInOneonoff(){
	var vievautoScan_AllInOneDIVonoff=document.getElementById("autoScan_AllInOneDIV");
	if (document.getElementById("autoScan_AllInOneDIVonoff").value==0){
		document.getElementById("autoScan_AllInOneDIVonoff").value=1;
		vievautoScan_AllInOneDIVonoff.style.display ='';
		document.getElementById("autoScan_AllInOneINPUT").focus();
	}else{
		document.getElementById("autoScan_AllInOneDIVonoff").value=0;
		vievautoScan_AllInOneDIVonoff.style.display ='none';
	}
};
function generujraport(){
	var user = document.getElementById("użytkownik").value;
	var dana = document.getElementById("viewOrder").textContent;
	var przycinanie = dana.slice(3);
    var skladowe =przycinanie.split("/");
    var aktkod =(skladowe[0]);
    var aktrr =(skladowe[3]);
    var aktmc =(skladowe[2]);
    var aktnrr=skladowe[1];

	$.ajax({
		type: "post",
		url: "php/raport.php",
	
		data: {
			user:user,
			dz_kod:aktkod,
			rr:aktrr,
			mc:aktmc,
			nr:aktnrr
		},
		success: function () {
			PokazUkryjTekst();
			searchIn(44,0);
			M.toast({html: 'Zmiana statusu zamówienia na ZATWIERDZONY'});
			},        
			error: function(xhr, status, error) {
			console.error(xhr);
		}
	})
};
function AutoRaportprzyzamówieniu(kod,rr,mc,nr){
	var user = document.getElementById("użytkownik").value;

	M.toast({html: 'Zamówienie przypisane do '+user});
	$.ajax({
		type: "get",
		url: "php/raportAuto.php",
		dataType: "json",
		data: {
			user:user,
			dz_kod:kod,
			rr:rr,
			mc:mc,
			nr:nr
		},
		success: function (response) {
			M.toast({html: 'Zamówienie przypisane do'+user});
		}
	})
}

function zanulowanieZamówieniaonoff(){
	var divAnulowanieZamówieniaonoff=document.getElementById('anulowanieZamówienia');
	if ( document.getElementById('anulowanieZamówieniaonoff').value == 1) {
		divAnulowanieZamówieniaonoff.style.display = 'none';
		document.getElementById('anulowanieZamówieniaonoff').value= 0;
	} else  {
		divAnulowanieZamówieniaonoff.style.display ='block';
		document.getElementById('anulowanieZamówieniaonoff').value= 1;
	};
}

// 	@Override
// protected void onNewIntent(Intent intent)
// {
//     super.onNewIntent(intent);
//     String decodedData = scanIntent.getStringExtra(getResources().getString(R.string.datawedge_intent_key_data));
//     String decodedLabelType = scanIntent.getStringExtra(getResources().getString(R.string.datawedge_intent_key_label_type));
//     String scan = decodedData + " [" + decodedLabelType + "]\n\n";
//     final TextView output = findViewById(R.id.txtOutput);
//     output.setText(scan + output.getText());
// }

// public boolean onTouch(View view, MotionEvent motionEvent) {
//     if (view.getId() == R.id.btnScan)
//     {
//         if (motionEvent.getAction() == MotionEvent.ACTION_DOWN)
//         {
//             //  Button pressed, start scan
//             Intent dwIntent = new Intent();
//             dwIntent.setAction("com.symbol.datawedge.api.ACTION");
//             dwIntent.putExtra("com.symbol.datawedge.api.SOFT_SCAN_TRIGGER", "START_SCANNING");
//             sendBroadcast(dwIntent);
//         }
//         else if (motionEvent.getAction() == MotionEvent.ACTION_UP)
//         {
//             //  Button released, end scan
//             Intent dwIntent = new Intent();
//             dwIntent.setAction("com.symbol.datawedge.api.ACTION");
//             dwIntent.putExtra("com.symbol.datawedge.api.SOFT_SCAN_TRIGGER", "STOP_SCANNING");
//             sendBroadcast(dwIntent);
//         }}
// }
var viewSzukajPoStanData=0;

function PokazUkryjSzukanie() {
	var divCalendaryWithSearch=document.getElementById('seachIconViev');
	if ( viewSzukajPoStanData == 1) {
	
		divCalendaryWithSearch.style.display = 'none';
		viewSzukajPoStanData=0;
	} 
	else if (viewSzukajPoStanData== 0) {
	
		divCalendaryWithSearch.style.display ='block';
		viewSzukajPoStanData=1;
	};
}
function zarzadzanieZeskanowanymiNumeramiParti(nr,idd){
	var schowDetailsScan=document.getElementById('editMode'+nr.toString(10)+'_'+idd.toString(10));
	
	if ( document.getElementById('zarzadzanieZeskanowanymiNumeramiPartionoff'+nr.toString(10)+'_'+idd.toString(10)).value == 0){
		schowNrParti(nr,idd);
		schowDetailsScan.style.display = '';
		document.getElementById('zarzadzanieZeskanowanymiNumeramiPartionoff'+nr.toString(10)+'_'+idd.toString(10)).value = 1;
	}else{
		schowDetailsScan.style.display = 'none';
		document.getElementById('zarzadzanieZeskanowanymiNumeramiPartionoff'+nr.toString(10)+'_'+idd.toString(10)).value = 0;
	}
}
function editData(nr, idd){

    var dataselectdetail1 = document.getElementById('dataselectdetail1_'+nr.toString(10)+'_'+idd.toString(10));
    var dataselectdetail2 = document.getElementById('dataselectdetail2_'+nr.toString(10)+'_'+idd.toString(10));
    var dataselectdetail3 = document.getElementById('dataselectdetail3_'+nr.toString(10)+'_'+idd.toString(10));
	var dataselectdetail4 = document.getElementById('dataselectdetail4_'+nr.toString(10)+'_'+idd.toString(10));
	
    var schowDetailsScan=document.getElementById('editMode'+nr.toString(10)+'_'+idd.toString(10));
	var editDataStyleCellTR1V=document.getElementById('editDataStyleCellTR1'+nr.toString(10)+'_'+idd.toString(10));
	var editDataStyleCellTR2V=document.getElementById('editDataStyleCellTR2'+nr.toString(10)+'_'+idd.toString(10));

	// console.log (nr , idd,);
    if ( document.getElementById('vievonoff'+nr.toString(10)+'_'+idd.toString()).value == 0) {
		//$( window ).scrollTo('#scan'+nr.toString(10)+'_'+idd.toString(10));
        dataselectdetail1.style.display = '';
        dataselectdetail2.style.display = '';
        dataselectdetail3.style.display = '';
		dataselectdetail4.style.display = '';
        document.getElementById('vievonoff'+nr.toString(10)+'_'+idd.toString(10)).value=1;
        document.getElementById('editDataStyleCell'+nr.toString(10)+'_'+idd.toString(10)).innerHTML= '<svg onclick = "editData('+nr+', \''+idd+'\' )" style="color: #f3da35" href="#scan'+nr+'_\''+idd+'\'" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-up-square-fill" viewBox="0 0 16 16"> <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11z" fill="white"></path> </svg></div>';	
		document.getElementById("scan"+nr.toString(10)+'_'+idd.toString(10)).focus();
		$('html,body').animate(
			{
				
			 scrollTop: $("#"+"editDataStyleCellTR2"+nr.toString(10)+"_"+kod.toString(10)).offset().top
			},
			'slow');
		
    
	}else{
       
		//$( window ).scrollTo('#scan'+nr.toString(10)+'_'+idd.toString(10));
        dataselectdetail1.style.display = 'none';
        dataselectdetail2.style.display = 'none';
        dataselectdetail3.style.display = 'none';
		dataselectdetail4.style.display = 'none';
        schowDetailsScan.style.display = 'none';
        
        document.getElementById('editDataStyleCell'+nr.toString(10)+'_'+idd.toString(10)).innerHTML= '<svg onclick = "editData('+nr+',\''+idd+'\')"value="${element.KOD_TOW}" style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-down-square-fill" viewBox="0 0 16 16"> <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 4a.5.5 0 0 0-.374.832l4 4.5a.5.5 0 0 0 .748 0l4-4.5A.5.5 0 0 0 12 6H4z" fill="white"></path> </svg></div>';	

		
		var ukrywwwanie=document.getElementById('dataselectdetail1_'+nr.toString(10)+'_'+idd.toString(10))
			if((document.getElementById('zarzadzanieZeskanowanymiNumeramiPartionoff'+nr.toString(10)+'_'+idd.toString(10)).value == 1)&&(document.getElementById('vievonoff'+nr.toString(10)+'_'+idd.toString(10)).value==1)){
				var editDataStyleCellTR1V= document.getElementById("editDataStyleCellTR1"+nr.toString(10)+'_'+idd.toString(10));
				var editDataStyleCellTR2V= document.getElementById("editDataStyleCellTR2"+nr.toString(10)+'_'+idd.toString(10));
				console.log('dddddd');
				editDataStyleCellTR1V.style.display='none';
				editDataStyleCellTR2V.style.display='none';
				var fgfg=document.getElementById('daneDoPrzywroceniaDoZamówienia').value;
				var dd=('_'+nr.toString(10)+'_'+idd.toString(10));
				console.log(dd)
				if (fgfg.indexOf(dd)==(-1)){
					console.log("ddd")
					fgfg=fgfg.toString(10)+'_'+nr.toString(10)+'_'+idd.toString(10);
					// console.log(fgfg);
					document.getElementById('daneDoPrzywroceniaDoZamówienia').value=fgfg;}

		}


		document.getElementById('zarzadzanieZeskanowanymiNumeramiPartionoff'+nr.toString(10)+'_'+idd.toString(10)).value = 0;
		document.getElementById('vievonoff'+nr.toString(10)+'_'+idd.toString(10)).value=0;
    };
};
function prelouder(x){
	var backgraund55=document.getElementById('prelouderoo');
	
	if (x==1){
		backgraund55.style.display ='';
		// console.log('1');	
	}else{
		backgraund55.style.display = 'none';
		// console.log('2');
	};
};
function autoScan_AllInOneDataOnOff(){
	var autoEanDataTableV=document.getElementById('autoEanDataTable');

	if(document.getElementById('autoScan_AllInOneDataDIVonoff').value==0){
	autoEanDataTableV.style.display='';
	document.getElementById('autoScan_AllInOneDataDIVonoff').value=1;
}else{
	autoEanDataTableV.style.display='none';
	document.getElementById('autoScan_AllInOneDataDIVonoff').value=0;

}
}

function pokazUkryjZrobioneF(){
	var fgfg=document.getElementById('daneDoPrzywroceniaDoZamówienia').value;
	M.toast({html: 'pokazano ukryte pozycje'});
	var przycinanie = fgfg.slice(1);
	var skladowe =przycinanie.split("_");
	var i =0;
while (i < skladowe.length){	
	var zmienna = document.getElementById('editDataStyleCellTR1'+(skladowe[i]).toString(10)+'_'+(skladowe[i+1]).toString(10));
	zmienna.style.display = (zmienna.style.display == '') ? 'none' : '';

	zmienna = document.getElementById('editDataStyleCellTR2'+(skladowe[i]).toString(10)+'_'+(skladowe[i+1]).toString(10));
	zmienna.style.display = (zmienna.style.display == '') ? 'none' : '';
	i=i+2;
};

}

// function showhide(id) {
// 	var e = document.getElementById(id);
// 	e.style.display = (e.style.display == 'block') ? 'none' : 'block';
// }
