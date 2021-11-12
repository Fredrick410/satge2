$(function(){
    "use strict";

    var fiscalContentNew = $(".fiscal-content-new"),
        fiscalToggleBtn = $(".fiscal-toggle-btn"),
        fiscalOverlay = $(".overlay"),
        fiscalAppOverlay = $(".app-overlay"),
        fiscalBDatable = $("#basic-datatable"),
        fiscalClose = $(".close-icon");
        

    fiscalToggleBtn.on('click',function(){
      fiscalAppOverlay.addClass("show");
      fiscalOverlay.addClass("show");
      fiscalBDatable.addClass("show");
      
    });

    fiscalClose.on('click',function(){
      fiscalAppOverlay.removeClass("show");
      fiscalOverlay.removeClass("show");
      fiscalBDatable.removeClass("show");
    });

    fiscalAppOverlay.on('click',function(){
      fiscalAppOverlay.removeClass("show");
      fiscalOverlay.removeClass("show");
      fiscalBDatable.removeClass("show");
    });
    
    /*fiscalBDatable.find(".show").on('click',function(){
      fiscalOverlay.removeClass("show");
      fiscalBDatable.removeClass("show");
    });

/*
    fiscalToggleBtn.on('click',function(){
        fiscalContentNew.removeClass("none-validation");
    });
*/
})