$(document).ready(function(){
 
    var url=document.location.href; $.each($(".nav-item a"),function(){
     
      if(this.href==url){$(this).addClass('active');};
     
      });
     
    });