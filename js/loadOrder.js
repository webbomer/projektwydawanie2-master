let  = [[]];

function dane(){
    //ukrywanie i pokazywanie elementów
     prelouder(1);
    

    var zz = document.activeElement.textContent;
    var przycinanie = zz.slice(3);
    var skladowe =przycinanie.split("/");
    var aktkod =skladowe[0];
    var aktrr =skladowe[3];
    var aktmc =skladowe[2];
    var aktnrr=skladowe[1];

    document.getElementById("viewOrder").innerHTML= "<h5 style='width:240px; color:#ffffff; margin-left:auto; padding:5px; position: relative;left:-10%;'>"+zz+"</h5> "
    document.getElementById("anulowanieZamówienia").innerHTML= "<h5 style='color:#ffffff; margin-left:auto; padding: 5px;text-align: center;'>Czy jesteś pewien/a że chcesz anulować przypisaną realizację zamówienia o numerach "+zz+" do twojego konta? </h5> <img src='./img/ikona-10.png' width=70 height=60 onclick='zanulowanieZamówieniaonoff()' style='position: relative;left:30%;margin:auto;top:10px'> </img><img src='./img/ikona-11.png' onclick='zanulowanieZamówieniaTAK()' width=70 height=60 style='position: relative;right:-40%;margin:auto;'> </img>"

 
    AutoRaportprzyzamówieniu(aktkod,aktrr,aktmc,aktnrr);
            $.ajax({
                type: "get",
                url: "loadloadOrder.php",
                dataType: "json",
                data: {
                    kod:aktkod,
                    rr:aktrr,
                    mc:aktmc,
                    nrr:aktnrr
                },
                success: function (response) {
                     var i = 1;
                     DaneZamówieniaX=[[]];
                    //  $('#kodAktywnegoSP').innerHTML=response.zamowienie.KodSP[0];
                    response.zamowienie.forEach(element => {

                         let a = [[,element.EAN1, element.mag_kod, element.ID,  element.KOD_TOW, ]]; 

                         DaneZamówieniaX+=a;    
                    });
                    // console.log(DaneZamówieniaX);
                    $('#order td').remove();
                    
                    response.zamowienie.forEach(element => { 
                        document.querySelector("#order").innerHTML+=`
                    <tr class="ukrywanieonoff${i}_${element.KOD_TOW}"  id="editDataStyleCellTR1${i}_${element.KOD_TOW}">
                        <td style="padding:0px;">${i}</td>
                        <td id="orderMagKod${i}_${element.KOD_TOW}">${element.mag_kod}</td>
                        <td id="orderLokalizacja${i}_${element.KOD_TOW}" style="padding:0px;">${element.Lokalizacja}</td>
                        <td id="orderKodTowarowy${i}_${element.KOD_TOW}">${element.KOD_TOW}</td>
                        <td style=display:none ><input id="vievonoff${i}_${element.KOD_TOW}" value="0"></input>
                        <input id="zarzadzanieZeskanowanymiNumeramiPartionoff${i}_${element.KOD_TOW}" value="0"></input>
                        </td>
                    </tr>
                    <tr class="daneDoskanu2" id="editDataStyleCellTR2${i}_${element.KOD_TOW}">
                        <td colspan="3" style="padding:1px; font-size:15px;> <button type="button" onclick = zarzadzanieZeskanowanymiNumeramiParti(${i},'${element.KOD_TOW}')> ${element.nazwa} </button></td>
                        <td id="editDataStyleCell${i}_${element.KOD_TOW}" style="padding:4px;"> 
                            
                            <svg onclick = "editData(${i},'${element.KOD_TOW}')"value="${element.KOD_TOW}" style="color: #f3da35" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-caret-down-square-fill" viewBox="0 0 16 16"> <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm4 4a.5.5 0 0 0-.374.832l4 4.5a.5.5 0 0 0 .748 0l4-4.5A.5.5 0 0 0 12 6H4z" fill="white"></path> </svg>
                            </div>
                        </td>
                        </tr>
                    <tr class="daneDoskanu" style=display:none id="dataselectdetail1_${i}_${element.KOD_TOW}">
                        <td> Waga </td>
                        <td>J.M.</td>
                        
                        
                        <td>op.+</td>
                        <td>ILR</td>
                    </tr>
                    <tr  class="daneDoskanu" style=display:none id="dataselectdetail2_${i}_${element.KOD_TOW}">
                        <td > ${Math.round(element.Waga)} </td>
                        <td id="JM${i}_${element.KOD_TOW}">${element.JednostkaMiary}</td>
                        
                        
                        <td > ${Math.round(element.ILR / element.ILOSC_NAW*100)/100}*${Math.round(element.ILOSC_NAW)}+${Math.round(element.ILR % element.ILOSC_NAW*100)/100} </td>
                        
                        <td >${Math.round(element.ILR*100)/100}</td>
                    
                    </tr>
                    <tr class="daneDoskanu" style=display:none id="dataselectdetail4_${i}_${element.KOD_TOW}">
                        <td>EAN<td>
                        <td colspan="3"> ${element.EAN1} </td>
                    </tr>
                    <tr  class="daneDoskanu2" style ="display:none">
                        <td id="id${i}_${element.KOD_TOW}" "colspan="4">${element.ID}</td>
                        
                
                    </tr>
                    <tr class="daneDoskanu3" style="display:none; padding:0px ;" id="dataselectdetail3_${i}_${element.KOD_TOW}">
                        <td colspan="3" style="padding:0px 10px"> <input  class="imputScanNrParti" type="text" id="scan${i}_${element.KOD_TOW}" autocomplete="off" placeholder=" " name="dodaj numer partii"> </input><label for="scan${i}_${element.KOD_TOW}" class="scanLabel"> dodaj nr partii </label> </td>
                        <td><type = "button" onclick = "przypisZamowienia(${i},'${element.KOD_TOW}')" > <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16"> <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z" fill="white"></path> </svg> </button> </td>
                    </tr>
                    <tbody id="editMode${i++}_${element.KOD_TOW}" class="daneDoskanu4">
                    <tr  style='display:none' class="daneDoskanu4"><td colspan="4"> Brak przypisanych numerów parti</td></tr>   
                    </tbody>`
                    });
                    var ss=0;
                    response.zamowienie.forEach(element => { 
                        ss=Math.round(+element.Waga);
                        console.log(ss);
                        document.querySelector("#order").innerHTML+=`
                        <tr>
                            <td colspan="4"> ${ss}</td>
                        </tr>
                        `
                    });
                },
                complete:function(){}
            }).done(function() {prelouder(2)})
            prelouder(2);
            PokazUkryjTekst();

}

function przypisZamowienia(nr,idd){
        
        var zz = document.getElementById("viewOrder").textContent;
        var przycinanie = zz.slice(3);
        var skladowe = przycinanie.split("/");
    var aktkod =(skladowe[0]);
    var aktrr =(skladowe[3]);
    var aktmc =(skladowe[2]);
    var aktnrr=skladowe[1];
    var jm =document.getElementById('JM'+nr.toString(10)+'_'+idd.toString(10)).textContent;
    var mag_kod=document.getElementById('orderMagKod'+nr.toString(10)+'_'+idd.toString(10)).textContent;
    
    var scanVar=document.getElementById('scan'+nr.toString(10)+'_'+idd.toString(10)).value;

    var ma_partie=1;

    var id=document.getElementById('id'+nr.toString(10)+'_'+idd.toString(10)).textContent.split("-");
    var sww_b = id[1];
    var sww_p = id[2];
    var sww_a = id[3];
    var sww_t = id[4];
    var naw_kod = id[5];

    $.ajax({
        type: "POST",
        url: "KWW_partie.php",
        // dataType: "json",
        data: {
            dz_kod:aktkod,             
            rr:aktrr,
            mc:aktmc,
            nr:aktnrr,
            mag_kod:mag_kod,
            sww_b:sww_b,
            sww_p:sww_p,
            sww_a:sww_a,
            sww_t:sww_t,
            naw_kod:naw_kod,
            jm:jm,
            ma_partie:ma_partie,
            nr_partii:scanVar
        },
        cache:false,
        
        success: function() {
            M.toast({html: 'Dodano nr partii'});
            document.getElementById('scan'+nr.toString(10)+'_'+idd.toString(10)).value='';
            schowNrParti(nr,idd);
        }
        // },
        // error: function(xhr, status, error) {
        //     console.error(xhr);
        // }
    });   
};
var user = document.getElementById("użytkownik").value;
$.ajax({
    type: "get",
    url: "loadOrder.php",
    dataType: "json",
     data: {
             Useer:user
    },
    success: function (response) {
        // prelouder(1);
         var ii = 1;
        response.zamowienia.forEach(element => {
            document.querySelector("#orderList").innerHTML+=`<tr>
            <td>${ii++}</td>
            <td style="  padding: 0px;"><button type = "button" onclick = "dane()" style="  padding: 0px;
            width: 190px;
            height: 80px;
            font-size:18px;" >${element.Numer}</button></td>
            <td>${element.ilosc}</td> 
            <td> ${element.sta} </td>
        </tr>`;
    
        //    console.log(element); 
        //               <td> <button type = "button" onclick = "dane()" ><svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"> <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" fill="blue"></path> </svg></button> </td>
        });
    },
    complete:function(){
        prelouder(2)
        
    }
})


function schowNrParti(nr,idd){
        
    var zz = document.getElementById("viewOrder").textContent;
    var przycinanie = zz.slice(3);
    var skladowe = przycinanie.split("/");
var aktkod =(skladowe[0]);
var aktrr =(skladowe[3]);
var aktmc =(skladowe[2]);
var aktnrr=skladowe[1];
var jm =document.getElementById('JM'+nr.toString(10)+'_'+idd.toString(10)).textContent;
var mag_kod=document.getElementById('orderMagKod'+nr.toString(10)+'_'+idd.toString(10)).textContent;

var scanVar=document.getElementById('scan'+nr.toString(10)+'_'+idd.toString(10)).value;

var ma_partie=1;

var id=document.getElementById('id'+nr.toString(10)+'_'+idd.toString(10)).textContent.split("-");
var sww_b = id[1];
var sww_p = id[2];
var sww_a = id[3];
var sww_t = id[4];
var naw_kod = id[5];

$.ajax({
    type: "get",
    url: "KWW_partieShow.php",
    dataType: "json",
    data: {
        dz_kod:aktkod,             
        rr:aktrr,
        mc:aktmc,
        nr:aktnrr,
        mag_kod:mag_kod,
        sww_b:sww_b,
        sww_p:sww_p,
        sww_a:sww_a,
        sww_t:sww_t,
        naw_kod:naw_kod,
        jm:jm,
        ma_partie:ma_partie,
        nr_partii:scanVar
    },
    success: function (response) {

        var i = 1;
        document.getElementById('editMode' + nr.toString(10) + '_' + idd.toString(10)).innerHTML = `<tr class="daneDoskanu4">
            <td>Lp</td>
            <td style="  padding: 0px;"> usuń</td>
            <td> lista nr. partii</td> 
            <td> edytuj</td></tr>`;
        response.zamowienie.forEach(element => {
            document.querySelector("#editMode"+nr.toString(10)+'_'+idd.toString(10)).innerHTML+=`
            <tr class="daneDoskanu4">
            <td> ${i++} </td>
            <td style="padding:0px;">  <img   onclick="deleteInKWW_partie(${nr},'${idd}','${element.nr_partii}','${element.lp}')"   src="./img/ikona-108.png" width="40" height="40"> </img></td>
            <td><input class="inputToNrPartii" id="nrPartiiEdytuj${nr}${idd}${element.lp}" value="${element.nr_partii}" autocomplite=off type=text></td> 
            <td style="padding:0px;">  <img  onclick="updataInKWW_partie(${nr},'${idd}','${element.lp}','${element.nr_partii}')"   src="./img/ikona-128.png" width="40" height="40"> </img></td>
            </tr>
            `
        });
    }
})
}

function autoScanInputData(){
    var scan =document.getElementById('autoScan_AllInOneINPUT').value;
    document.getElementById('autoScan_AllInOneINPUT').value='';  
    $.ajax({
            type: "get",
            url: "php/EAN_auto.php",
            dataType: "json",
            data: {
                scan:scan
            },
            success: function (response) {
                var ean=response.zamowienie["ean"];
                var batch=response.zamowienie["nr_partii"];

                var skladowe2 = DaneZamówieniaX.slice(1).split(",");
                var i=0;

                
                // console.log(ean);
                // console.log(batch);

                while(i<skladowe2.length ){     
                    if(skladowe2[i]==ean){
                        // console.log(skladowe2[i+3]);
                        var kod=skladowe2[i+3].toString(10);
                        // console.log(kod);
                        var nr =(i/4)+1;
                        if (document.getElementById('vievonoff'+nr.toString(10)+'_'+kod.toString(10)).value==0){
                        editData(nr,kod);}

                        document.getElementById("scan"+nr.toString(10)+"_"+kod.toString(10)).focus();

                        document.getElementById("scan"+nr.toString(10)+"_"+kod.toString(10)).value=batch;
                        // console.log(nr);
                        
                    //     $('#myButton').click(function(event) {
                    //         event.preventDefault();
                    //         $.scrollTo($('scan'+nr.toString(10)+'_'+kod.toString(10)), 1000);
                    //    });

                    $('html,body').animate(
                        {
                            
                         scrollTop: $("#"+"editDataStyleCellTR2"+nr.toString(10)+"_"+kod.toString(10)).offset().top
                        },
                        'fast');
                    }
                    i=i+4;

                }
            console.log(skladowe2);
            }

    })
}