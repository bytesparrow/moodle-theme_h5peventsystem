console.log("Hello, this is h5p_media_goto_eventlistener.js!");
(function ($) {
    $(document).ready(function () {

        //event: media_goto
        /**
         * The event will be triggered via 
         * var event = new CustomEvent('media_goto',  
         * {detail: { type: "h5p", object: "20",  position:89, time: new Date() }, } );
         * window.dispatchEvent(event)
        */
        //observe window.top: we are in an iframe.
        $(window.top).on("media_goto", function (e) {
            console.debug("in h5peventsystem, event:");
            console.debug(e);
            //console.debug("Es gibt X H5p instances " + H5P.instances.length);

            //da h5p-instances immer in einem iframe sind, gibt es immer nur eine.
            var h5pinstance = H5P.instances[0];
            console.debug("this h5pinstance is:");
            console.debug(h5pinstance);
            var evt = e.detail;
            if (evt.type == "h5p") {
                var eventh5pcid = evt.object;
                var eventtimecode = evt.position;

                
                //is this event for this h5pinstance?
                if (h5pinstance.contentId == eventh5pcid) {
                    switch (h5pinstance.libraryInfo.machineName) {

                        case 'H5P.Audio':
                            h5pinstance.audio.currentTime = eventtimecode;
                            break;
                        case 'H5P.InteractiveVideo':
                            //object.seek genügt für videos
                            h5pinstance.seek(eventtimecode);
                            //weitere mögliche aktionen: h5p_object.showInteractions(); h5p_object.recreateCurrentInteractions();  h5p_object.timeUpdate(timestamp); h5p_object.video.seek(timestamp);
                            //console.debug(element);
                            //setTimeout(function(){element.timeUpdate(timestamp);}, 500);
                            break;
                        default:
                            alert("unsupported type:" + h5pinstance.libraryInfo.machineName + "in h5p_media_goto_eventlistener.js");
                            break;
                    }
                } //else: nothing to do


            }


        });

    })

})(H5P.jQuery);
