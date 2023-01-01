$('#toggle_fullscreen').on('click', function(){
  // if already full screen; exit
  // else go fullscreen
  if (
    document.fullscreenElement ||
    document.webkitFullscreenElement ||
    document.mozFullScreenElement ||
    document.msFullscreenElement
  ) {
    if (document.exitFullscreen) {
      document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
      document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
      document.msExitFullscreen();
    }
  } else {
    element = $('#fullscreen_container').get(0);
    if (element.requestFullscreen) {
      element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
      element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
      element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
    } else if (element.msRequestFullscreen) {
      element.msRequestFullscreen();
    }
  }
});

$('#export_svg').on('click', function(){
    var svgElement = document.getElementById("familytree");
    var screenHeight = window.screen.height;
    var screenWidth = window.screen.width;
    var windowHeight = screenHeight * 2/3;
    var windowWidth = screenWidth * 2/3;
    var printWindow = window.open("", "_blank", "height=" + windowHeight + ",top=100,width=" + windowWidth + ",left=" + (screenWidth - windowWidth)/2);
    printWindow.document.write('<html><head><title></title><link rel="stylesheet" type="text/css" href="/css/print.css" media="all" type="text/css" /></head><body>');
    printWindow.document.write(svgElement.innerHTML);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    setTimeout(function(){printWindow.print();}, 500);

});
