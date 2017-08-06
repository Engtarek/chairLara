window.chair=function(){
  let down=false;
  let startPoint=null;
  let x=0;
  let y=0;
  let offset=25;
  $('.parent').on('mousedown touchstart',function (e) {

      down=true;
      if(e.type == 'mousedown'){
          startPoint=e.clientX;
      }else if(e.type == 'touchstart'){
          startPoint=e.originalEvent.touches[0].clientX;
      }


  });
  $('.parent').on('mousemove touchmove',function (e) {

      if(e.type == 'mousemove'){
        if(down){
              $('#load_360').css('display','none');
            if((e.clientX-startPoint)-offset>0){
                startPoint=e.clientX;

                 if(x===-2100){
                    x=0;
                     y-=700;
                     $(this).find("div").css('background-position',x +'px '+y+'px');
                }else{
                  x-=700;
                  $(this).find("div").css('background-position',x +'px '+y+'px');
                }
                if(y === -1400){
                  y=0;
                }
            }else if((e.clientX-startPoint)+offset<0){

              startPoint=e.clientX;
              if(x===0){
                  x-=2100;
                  y-=700;
                  $(this).find("div").css('background-position',x +'px '+y+'px');

              }else{
                  x+=700;
                  $(this).find("div").css('background-position',x +'px '+y+'px');
              }
              if(y === -1400  ){
                y=0;
              }
            }

  }
}else if(e.type == 'touchmove'){
  if(down){
      $('#load_360').css('display','none');
      if((e.originalEvent.touches[0].clientX-startPoint)-offset>0){

          startPoint=e.originalEvent.touches[0].clientX;
          if(x===-2100){
              x=0;
              y-=700;
              $(this).find("div").css('background-position',x +'px '+y+'px');

          }else{
              x-=700;
              $(this).find("div").css('background-position',x +'px '+y+'px');
          }

      }else if((e.originalEvent.touches[0].clientX-startPoint)+offset<0){
        startPoint=e.originalEvent.touches[0].clientX;
        if(x===0){
            x-=2100;
            y-=700;
            $(this).find("div").css('background-position',x +'px '+y+'px');

        }else{
            x+=700;
            $(this).find("div").css('background-position',x +'px '+y+'px');
        }
      }

}
}

  });
  $(".parent").on('mouseup touchend',function (e) {
      down=false;
      startPoint=null;
  });




}
