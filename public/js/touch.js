var left,product_id;
function lefttouch(left,product_id){
    $(".parent").on('swipeleft',function (e) {
      var myPos = $(this).find("."+left+"").css("background-position").split(" ");
    myPos[0] = parseInt(myPos[0].replace("px",""));
    myPos[1] = parseInt(myPos[1].replace("px",""));

    if(myPos[0] === 0 && myPos[1] === 0 ){
       myPos[0] = -2100;
       myPos[1] = -700;
         $(this).find("."+left+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
    }else if(myPos[0] <0 && myPos[1] === -700 ){
      myPos[0] = myPos2[0] + 700;
      myPos[1] = -700;
        $(this).find("."+left+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }else if(myPos[0] === 0 && myPos[1] == -700 ){
     myPos[0] = -2100;
     myPos[1] = 0;
      $(this).find("."+left+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }else if(myPos[0] < 0 && myPos[1] === 0 ){
       myPos[0] = myPos[0] + 700;
       myPos[1] = 0;
      $(this).find("."+left+"").css("background-position", myPos[0]+'px ' + myPos[1] + 'px');
   }
  });
}
/////////////////////////////////////////////////////////////

var right,product_id;
function righttouch(right,product_id){
    $(".parent").on('swiperight',function (e) {
      var myPos2 = $(this).find("."+right+"").css("background-position").split(" ");
    myPos2[0] = parseInt(myPos2[0].replace("px",""));
    myPos2[1] = parseInt(myPos2[1].replace("px",""));

    if(myPos2[0] > -2100 && myPos2[1] == 0 ){
       myPos2[0] = myPos2[0] - 700;
       myPos2[1] = 0;
         $(this).find("."+right+"").css("background-position", myPos2[0]+'px ' + myPos2[1] + 'px');
    }else if(myPos2[0] == -2100 && myPos2[1] == 0 ){
      myPos2[0] = 0;
      myPos2[1] = -700;
        $(this).find("."+right+"").css("background-position", myPos2[0]+'px ' + myPos2[1] + 'px');
   }else if(myPos2[0] > -2100 && myPos2[1] == -700 ){
     myPos2[0] = myPos2[0] -700;
     myPos2[1] = -700;
      $(this).find("."+right+"").css("background-position", myPos2[0]+'px ' + myPos2[1] + 'px');
   }else{
     myPos2[0] = 0;
     myPos2[1] = 0;
      $(this).find("."+right+"").css("background-position", myPos2[0]+'px ' + myPos2[1] + 'px');
   }
  });
}
///////////////////////////////////////////////////////////////////////////

var clickparam,product_id;
function clicktouch(clickparam,product_id){
  $(".parent").on('tap',function(){

      var myPos3 = $(this).find("."+clickparam+"").css("background-position").split(" ");
    myPos3[0] = parseInt(myPos3[0].replace("px",""));
    myPos3[1] = parseInt(myPos3[1].replace("px",""));

    if(myPos3[0] > -2100 && myPos3[1] == 0 ){
       myPos3[0] = myPos3[0] - 700;
       myPos3[1] = 0;
         $(this).find("."+clickparam+"").css("background-position", myPos3[0]+'px ' + myPos3[1] + 'px');
    }else if(myPos3[0] == -2100 && myPos3[1] == 0 ){
      myPos3[0] = 0;
      myPos3[1] = -700;
        $(this).find("."+clickparam+"").css("background-position", myPos3[0]+'px ' + myPos3[1] + 'px');
   }else if(myPos3[0] > -2100 && myPos3[1] == -700 ){
     myPos3[0] = myPos3[0] -700;
     myPos3[1] = -700;
      $(this).find("."+clickparam+"").css("background-position", myPos3[0]+'px ' + myPos3[1] + 'px');
   }else{
     myPos3[0] = 0;
     myPos3[1] = 0;
      $(this).find("."+clickparam+"").css("background-position", myPos3[0]+'px ' + myPos3[1] + 'px');
   }

  });
}
