// function schowNrParti(nr,idd){
        
//     var zz = document.getElementById("viewOrder").textContent;
//     var przycinanie = zz.slice(3);
//     var skladowe = przycinanie.split("/");
// var aktkod =parseInt(skladowe[0]);
// var aktrr =parseInt(skladowe[3]);
// var aktmc =parseInt(skladowe[2]);
// var aktnrr=skladowe[1];
// var jm =document.getElementById('JM'+nr.toString(10)+'_'+idd.toString(10)).textContent;
// var mag_kod=document.getElementById('orderMagKod'+nr.toString(10)+'_'+idd.toString(10)).textContent;

// var scanVar=document.getElementById('scan'+nr.toString(10)+'_'+idd.toString(10)).value;

// var ma_partie=1;

// var id=document.getElementById('id'+nr.toString(10)+'_'+idd.toString(10)).textContent.split("-");
// var sww_b = id[1];
// var sww_p = id[2];
// var sww_a = id[3];
// var sww_t = id[4];
// var naw_kod = id[5];

// console.log( aktkod, aktrr, aktmc, aktnrr, mag_kod, sww_b, sww_p, sww_a, sww_t, naw_kod, jm, ma_partie, scanVar )

// $.ajax({
//     type: "get",
//     url: "KWW_partieShow.php",
//     dataType: "json",
//     data: {
//         dz_kod:aktkod,             
//         rr:aktrr,
//         mc:aktmc,
//         nr:aktnrr,
//         mag_kod:mag_kod,
//         sww_b:sww_b,
//         sww_p:sww_p,
//         sww_a:sww_a,
//         sww_t:sww_t,
//         naw_kod:naw_kod,
//         jm:jm,
//         ma_partie:ma_partie,
//         nr_partii:scanVar
//     },
//     success: () => {

//         var i = 0;
//         console.log('działa');
//         document.getElementById('editMode' + nr.toString(10) + '_' + idd.toString(10)).innerHTML = `<tr>
//             // <td>Lp</td>
//             // <td style="  padding: 0px;"> usuń</td>
//             // <td> nr. partii</td> 
//             // <td> edytuj</td></tr>`;

//         response.zamowienia.forEach(element => {
//             document.querySelector('editMode' + nr.toString(10) + '_' + idd.toString(10)).innerHTML += `<tr>
//            <td>${i++}</td>
//            <td style="  padding: 0px;">  <img id=""  onclick="updataInKWW_partie(${nr},'${idd}',${i})"   src="../img/ikona-108.png" width="40" height="40"> </img></td>
//            <td>${element.nr_partii}</td> 
//            <td> style="  padding: 0px;">  <img id="" onclick="deleteInKWW_partie((${nr},'${idd}',${i}))"   src="../img/ikona-128.png" width="40" height="40"> </img></td>
//        </tr>`;

//         });

//     }
// })
// }
