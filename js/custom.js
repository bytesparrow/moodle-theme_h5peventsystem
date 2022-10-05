console.log("Hello, this is custom.js!");
(function ($) {
  $(document).ready(function () {

    setTimeout(function () {
      $('.h5p-control.h5p-playbackRate').css('background', 'green');

    }, 5000);

    return; //hier kommt lauter spaß zum debuggen
    H5P.externalDispatcher.on('*', function(event){console.debug("H5P-Event");
     console.debug(event)});

    alert("warning. this is h5peventsystem: video will jump to 42secs in 10 seconds... ");
    console.debug("list of all instances:");
    console.debug(H5P.instances);

    console.debug("list of all H5P-capabilities:");
    console.debug(H5P);


    console.debug("See the H5pintegration-contents:");
    console.debug(H5PIntegration.contents);


    //react on events:
    
    setTimeout(function () {
      H5P.instances[0].seek(42) 
    }, 10000)

    console.debug("what is windows.top?");
    console.debug($(window.top));
 


  })

})(H5P.jQuery);
