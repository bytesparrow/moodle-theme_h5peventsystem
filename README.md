H5PEventSystem
==========

This H5PEventSystem theme provides an API to connect to H5P-Content. If you want to use it in your own project, create a sub-theme of this theme.
This theme is experimental.

## Getting started

1. Clone the repository to your theme folder
2. write your own theme extending THIS theme AND any other (for example boost)
3. Enable YOUR theme in your Moodle server under the appearance settings

## Usage

You can now fire events like this:
    var event = new CustomEvent('media_goto',  
          {detail: { type: "h5p", object: "20",  position:89, time: new Date() }, } );
    window.dispatchEvent(event);

## About
Ath the moment it's still something like pre-alpha and more or less a prove of concept. But it will be extended in the near future.

## Requirements

This theme requires Moodle 4.0+
