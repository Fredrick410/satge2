var myVar = setInterval(function(){myTimer()}, 1000);

function myTimer() {
    var d = new Date();
  
    var s = d.getSeconds();
    var m = d.getMinutes();
    var h = d.getHours();
    
    var sCircle = s/60*360;
    var mCircle = m/60*360;
    var hCircle = h/12*360;
    
    $('#secondes').css({'-webkit-transform':'rotate('+sCircle+'deg)'});
    $('#minutes').css({'-webkit-transform':'rotate('+mCircle+'deg)'});
    $('#heures').css({'-webkit-transform':'rotate('+hCircle+'deg)'});
}