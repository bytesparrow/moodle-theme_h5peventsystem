<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

namespace theme_h5peventsystem\output;
/**
 * Theme h5peventsystem
 *
 * @package    theme_h5peventsystem
 * @copyright  2022 Bernhard Strehl <moodle@software.bernhard-strehl.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Class core_h5p_renderer extends \core_h5p\output\renderer.
 *
 * Extends the H5P renderer so that we are able to override the relevant
 * functions declared there.
 */
class core_h5p_renderer extends \core_h5p\output\renderer {

    /**
     * Add styles when an H5P is displayed.
     *
     * @param array $styles Styles that will be applied.
     * @param array $libraries Libraries that wil be shown.
     * @param string $embedType How the H5P is displayed.
     */
    public function h5p_alter_styles(&$styles, $libraries, $embedtype) {
        global $CFG;
        if (
            isset($libraries['H5P.InteractiveVideo']) &&
            $libraries['H5P.InteractiveVideo']['majorVersion'] == '1'
        ) {
            $styles[] = (object) array(
                'path'    => $CFG->httpswwwroot . '/theme/h5peventsystem/style/custom.css',
                'version' => '?ver=0.0.2',
            );
        }
    }

    /**
     * Add scripts when an H5P is displayed.
     *
     * @param object $scripts Scripts that will be applied.
     * @param array $libraries Libraries that will be displayed.
     * @param string $embedType How the H5P is displayed.
     */
    public function h5p_alter_scripts(&$scripts, $libraries, $embedtype) {
        global $CFG;
        // This is for testing purposes.
        if (
            isset($libraries['H5P.InteractiveVideo']) &&
            $libraries['H5P.InteractiveVideo']['majorVersion'] == '1'
        ) {
            $includefile = ($embedtype === 'editor' ? 'customEditor.js' : 'custom.js');
            $scripts[] = (object) array(
                'path'    => $CFG->httpswwwroot . '/theme/h5peventsystem/js/' . $includefile,
                'version' => '?ver=0.0.2',
            );
        }
        // Hier kommt der eventlistener für video,audio.
        // For codedoc see h5p_media_goto_eventlistener.js .
        if (
            isset($libraries['H5P.InteractiveVideo']) &&
            $libraries['H5P.InteractiveVideo']['majorVersion'] == '1'
            ||
            isset($libraries['H5P.Audio']) &&
            $libraries['H5P.Audio']['majorVersion'] == '1'
        ) {
            if ($embedtype != "editor") {
                $scripts[] = (object) array(
                    'path'    => $CFG->httpswwwroot . '/theme/h5peventsystem/js/h5p_media_goto_eventlistener.js',
                    'version' => '?ver=0.0.2',
                );
            }
        }

    }

    /**
     * Alter a library's semantics
     *
     * May be used to ad more fields to a library, change a widget, allow more
     * html tags, etc.
     *
     * @param array $semantics Library semantics
     * @param string $name Name of library
     * @param int $majorVersion Major version of library
     * @param int $minorVersion Minor version of library
     */
    public function h5p_alter_semantics(&$semantics, $name, $majorversion, $minorversion) {
        if (
            $name === 'H5P.MultiChoice' &&
            $majorversion == 1
        ) {
            array_shift($semantics);
        }
    }

    /**
     * Alter an H5Ps parameters.
     *
     * May be used to alter the content itself or the behaviour of an H5
     *
     * @param object $parameters Parameters of library as json object
     * @param string $name Name of library
     * @param int $majorVersion Major version of library
     * @param int $minorVersion Minor version of library
     */
    public function h5p_alter_filtered_parameters(&$parameters, $name, $majorversion, $minorversion) {
        if (
            $name === 'H5P.MultiChoice' &&
            $majorversion == 1
        ) {
            $parameters->question .= '<p> Generated at ' . time() . '</p>';
        }
    }
}


