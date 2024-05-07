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
   ```
   var event = new CustomEvent('media_goto',  
          {detail: { type: "h5p", object: "20",  position:89, time: new Date() }, } );
    window.dispatchEvent(event);
 ```
(the object - "20" in this case - must be your own H5P-Content-ID.)

## About
At the moment it's still something like pre-alpha and more or less a prove of concept. But it will be extended in the near future.

## Requirements

This theme requires Moodle 4.0+


## License ##

2022 Bernhard Strehl <moodle@bytesparrow.de>

This program is free software: you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation, either version 3 of the License, or (at your option) any later
version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with
this program.  If not, see <https://www.gnu.org/licenses/>.
