$(document).ready(function(){
    $(".add").click(function () {
      
        $(".files").css("display","flex");
        
    })
    $(".quit").click(function (){
        $(".files").css('display','none')
        $(".details").hide(1500);
    });
    $(".likes").click(function (){
        $(".dislike").css('display','flex');
        $(".likes").css('display','none');
    });
     /*
    $(".dilikes").click(function (){
        
        $(".likes").css('display','flex');
        $(".dislikes").css('display','none');
    });
   $(".follow").click(function () {
        $(".details").css('display','flex');
    })*/
})