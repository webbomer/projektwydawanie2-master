// zmiany numerów parti w tabeli KWW_partie
function updataInKWW_partie(nr,idd,lpP,oldScan){

    var zz = document.getElementById("viewOrder").textContent;
    var przycinanie = zz.slice(3);
    var skladowe = przycinanie.split("/");
var aktkod =(skladowe[0]);
var aktrr =(skladowe[3]);
var aktmc =(skladowe[2]);
var aktnrr=skladowe[1];
var jm =document.getElementById('JM'+nr.toString(10)+'_'+idd.toString(10)).textContent;

var mag_kod=document.getElementById('orderMagKod'+nr.toString(10)+'_'+idd.toString(10)).textContent;

var oldScanVar = oldScan;

var scanVar=document.getElementById('nrPartiiEdytuj'+nr.toString(10)+idd.toString(10)+lpP.toString(10)).value;
console.log (scanVar);

var ma_partie=1;
var lp = lpP;
var id=document.getElementById('id'+nr.toString(10)+'_'+idd.toString(10)).textContent.split("-");
var sww_b = id[1];
var sww_p = id[2];
var sww_a = id[3];
var sww_t = id[4];
var naw_kod = id[5];

console.log (aktkod, aktrr,aktmc,aktnrr,mag_kod,sww_b,sww_p,sww_a,sww_t, naw_kod,jm,ma_partie,scanVar, lp);

    $.ajax({
        type: "POST",
        url: "updateKWW_partie.php",
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
            nr_partii:scanVar,
            lp:lp,
            oldScan:oldScanVar
        },
        cache:false,
        
        success: function() {
            M.toast({html: 'Nr partii '+oldScanVar+' został zaktualizowany na '+scanVar});
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    }); 
};
function deleteInKWW_partie(nr,idd,scan,lpP){

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
var lp = lpP;
var id=document.getElementById('id'+nr.toString(10)+'_'+idd.toString(10)).textContent.split("-");
var sww_b = id[1];
var sww_p = id[2];
var sww_a = id[3];
var sww_t = id[4];
var naw_kod = id[5];


var scanVar = scan;

    $.ajax({
        type: "POST",
        url: "delete.php",
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
            nr_partii:scanVar,
            lp:lp
        },
        cache:false,
        
        success: function(data) {

            zarzadzanieZeskanowanymiNumeramiParti(nr,idd);zarzadzanieZeskanowanymiNumeramiParti(nr,idd);
            M.toast({html: 'Nr partii '+scanVar+' został usunięty'});
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    }); 
};
function zanulowanieZamówieniaTAK(){
     
        var zz = document.getElementById("viewOrder").textContent;
        var przycinanie = zz.slice(3);
        var skladowe = przycinanie.split("/");
    var aktkod =(skladowe[0]);
    var aktrr =(skladowe[3]);
    var aktmc =(skladowe[2]);
    var aktnrr=skladowe[1];

    var user = document.getElementById("użytkownik").value;

    $.ajax({
        type: "POST",
        url: "php/deleteERROR.php",
        data: {
            dz_kod:aktkod,
            rr:aktrr,
            mc:aktmc,
            nr:aktnrr,
            user:user           
        },
        cache:false,
        
        success: function(data) {
            zanulowanieZamówieniaonoff();
            PokazUkryjTekst();
            M.toast({html: 'Anulowano przypisanie zamówienia '+zz});
        },
        error: function(xhr, status, error) {
            console.error(xhr);
        }
    }); 
}