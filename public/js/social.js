var url , product_name;
function social(url,product_name){
  $(".social").jsSocials({
    shares: ["twitter", "facebook", "googleplus", "pinterest"],
    url: url,
    text: product_name,
    showLabel: false,
    showCount: false,
  });
}
