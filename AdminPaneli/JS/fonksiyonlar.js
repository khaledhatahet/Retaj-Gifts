$(document).ready(function(){
    
    // $.SoruIcerigikGoster = function(ElemanIDsi){

    //     var SoruIDsi = ElemanIDsi;
    //     var IslenecekAlan = "#" + ElemanIDsi;
    //     //$(".SorununCevapAlani").slideUp();
    //     $(IslenecekAlan).parent().find(".SorununCevapAlani").slideToggle();
       
    // }
    // $.SoruIcerigikGoster = function(){

    //     var IslenecekAlan = $(this).attr("class");
    //     alert(IslenecekAlan);
    //     $(IslenecekAlan).slideToggle();
    // }

    $(".urun").click(function(e){
        e.preventDefault();
        var IslenecekAlan = $(this).find(".siparisDetayi");
        $(IslenecekAlan).slideToggle();
    });
});

