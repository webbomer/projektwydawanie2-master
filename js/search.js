
function searchIn (searchStatus,ui){
    var dataSpectrum = document.getElementById("datachange").value;
    var user = document.getElementById("użytkownik").value;
    var zz = document.getElementById("szukaj").value;
    // console.log(aktmcP,aktmcK,aktrrP,aktrrK,ui,zz,user);
    // console.log(aktmcP,aktmcK,aktrrP,aktrrK,ui,zz,user);
    //M.toast({html: 'Zmiana zakresu zamówień!'});
    // if(zz.lenght==0){ui=0;};
    // console.log(aktmcP,aktmcK,aktrrP,aktrrK,ui,zz,user);
    if(ui==1){
        var zz = document.getElementById("szukaj").value;
        document.getElementById("szukaj").value='';
        searchStatus = document.getElementById("searchStatusView").value;
        if(dataSpectrum==1){
            var aktmcP=document.getElementById("mcP").value;
            var aktmcK=document.getElementById("mcK").value;
            var aktrrP=document.getElementById("rrP").value;
            var aktrrK=document.getElementById("rrK").value;
                console.log(aktmcP,aktmcK,aktrrP,aktrrK,ui,zz,user);
            $.ajax({
                    type: "get",
                    url: "php/search11.php",
                    dataType: "json",
                    data: {
                        mcP:aktmcP,
                        mcK:aktmcK,
                        rrP:aktrrP,
                        rrK:aktrrK,
                        szukaj:zz,
                        sta:searchStatus,
                        user:user
                    },
                    success: function (response) {
                        $('#orderList td').remove();
                        var ii = 1;
                        response.zamowienia.forEach(element => {
                        document.querySelector("#orderList").innerHTML+=`<tr>
                            <td>${ii++}</td>
                            <td><button type = "button" onclick = "dane()"  >${element.Numer}</button></td>
                            <td>${element.ilosc}</td>
                            <td> ${element.sta} </td>
                        </tr>`;
                        document.getElementById("searchStatusView").value=searchStatus;
                        });
                    },error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                })
        }else{
            console.log(searchStatus,user,zz);
                $.ajax({
                    type: "get",
                    url: "php/search10.php",
                    dataType: "json",
                    data: {
                        szukaj:zz,
                        sta:searchStatus,
                        user:user

                    },
                    success: function (response) {
                        $('#orderList td').remove();
                        var ii = 1;
                        response.zamowienia.forEach(element => {
                        document.querySelector("#orderList").innerHTML+=`<tr>
                            <td>${ii++}</td>
                            <td><button type = "button" onclick = "dane()"  >${element.Numer}</button></td>
                            <td>${element.ilosc}</td>
                            <td> ${element.sta} </td>
                        </tr>`;   
                        });
                    },        error: function(xhr, status, error) {
                        console.error(xhr);
                    }
                })
            };
    }else{
        if(dataSpectrum==1){
            // var mcP=document.getElementById("mcP").value;
            // var mcK=document.getElementById("mcK").value;
            // var rrP=document.getElementById("rrP").value;
            // var rrK=document.getElementById("rrK").value;
            $.ajax({
                type: "get",
                url: "php/search01.php",
                dataType: "json",
                data: {
                    mcP:aktmcP,
                    mcK:aktmcK,
                    rrP:aktrrP,
                    rrK:aktrrK,
                    sta:searchStatus,
                    user:user

                },
                success: function (response) {
                    $('#orderList td').remove();
                    var ii = 1;
                    document.getElementById("searchStatusView").value=searchStatus;
                    response.zamowienia.forEach(element => {
                    document.querySelector("#orderList").innerHTML+=`<tr>
                        <td>${ii++}</td>
                        <td><button type = "button" onclick = "dane()"  >${element.Numer}</button></td>
                        <td>${element.ilosc}</td>
                        <td> ${element.sta} </td>
                    </tr>`;     
                    
                    });
                } 
            })
        }else{
            console.log(searchStatus,user)
            $.ajax({
                type: "get",
                url: "php/search00.php",
                dataType: "json",
                data: {
                    sta:searchStatus,
                    user:user
                },
                success: function (response) {
                    document.getElementById("searchStatusView").value=searchStatus;
                    //console.log(searchStatus,user)
                    $('#orderList td').remove();
                    var ii = 1;
                    response.zamowienia.forEach(element => {
                    document.querySelector("#orderList").innerHTML+=`<tr>
                        <td>${ii++}</td>
                        <td><button type = "button" onclick = "dane()"  >${element.Numer}</button></td>
                        <td>${element.ilosc}</td>
                        <td> ${element.sta} </td>
                    </tr>`;     

                    });
                }
            })
        }
    }
}
var calendary=0;
// document.getElementById("mcP").value=(getMonth());
// document.getElementById("mcK").value=(getMonth());
// document.getElementById("rrP").value=getFullYear();
// document.getElementById("rrK").value=getFullYear();
function schowCalendary (){
    if (calendary ==0){
        calendarySchow.style.display = 'block';
        calendary=1;
        document.getElementById("datachange").value=1;
        document.getElementById("seachIcon").interHtml='<svg onclick="searchIn(22,1)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" fill="blue"></path> </svg>;';

    }else{
        calendarySchow.style.display = 'none';
        calendary=0;
        document.getElementById("datachange").value=0;
        document.getElementById("seachIcon").interHtml='<svg onclick="searchIn(22,0)" style="color: blue" xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"> <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" fill="blue"></path> </svg>;';

    };
}

function dataSchereSpectrum (){
    var mc_P = document.getElementById("$mc.p").value;
    console.log(mc_P);
    // document.getElementById("mcK").value;
    // document.getElementById("rrP").value;
    // document.getElementById("rrK").value;
    //document.getElementById("$mc.p").value=document.getElementById("mc_P").value;
    // document.getElementById("$rr.p").value=document.getElementById("mcK").value;
    // document.getElementById("$mc.k").value=document.getElementById("rrP").value;
    // document.getElementById("$rr.k").value=document.getElementById("rrK").value;
    document.getElementById("datachange").value=1;

}