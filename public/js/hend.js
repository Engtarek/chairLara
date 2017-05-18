let param3;
function touchchair(param3){
  let down=false;
  let startPoint=null;
  let x=0;
  let y=0;
  let offset=25;
  $('.parent').on('touchstart',function (e) {
      down=true;
      startPoint=e.originalEvent.touches[0].pageX;
  });
  $('.parent').on('touchmove',function (e) {
      if(down){
          if((e.originalEvent.touches[0].pageX-startPoint)-offset>0){

              startPoint=e.originalEvent.touches[0].pageX;
              if(x===-2100){
                  x=0;
                  y-=700;
                  $(this).find('.'+param3+'').css('background-position',x +'px '+y+'px');

              }else{
                  x-=700;
                  $(this).find('.'+param3+'').css('background-position',x +'px '+y+'px');
              }

          }else if((e.originalEvent.touches[0].pageX-startPoint)+offset<0){
            startPoint=e.originalEvent.touches[0].pageX;
            if(x===0){
                x-=2100;
                y-=700;
                $(this).find('.'+param3+'').css('background-position',x +'px '+y+'px');

            }else{
                x+=700;
                $(this).find('.'+param3+'').css('background-position',x +'px '+y+'px');
            }
          }

}
  });
  $('.parent').on(' touchend',function (e) {
      down=false;
      startPoint=null;
  });

}
