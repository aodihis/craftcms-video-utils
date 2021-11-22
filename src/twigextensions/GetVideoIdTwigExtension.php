<?php
/**
 * Get Video Id plugin for Craft CMS 3.x
 *
 * Twig filter to get the video id of youtube or Vimeo URL.
 *
 * @link      https://github.com/aodihis
 * @copyright Copyright (c) 2021 aodihis
 */

namespace aodihis\getvideoid\twigextensions;

use aodihis\getvideoid\GetVideoId;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    aodihis
 * @package   GetVideoId
 * @since     1.0.0
 */
class GetVideoIdTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'GetVideoId';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('getYoutubeId', [$this, 'getYoutubeId']),
            new TwigFilter('getVimeoId', [$this, 'getVimeoId']),
        ];
    }

    /**
     * Our function called via Twig; 
     *
     * @param null $url
     *
     * @return string
     */
    public function getYoutubeId($url = null)
    {
        if (preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $result)){
            return $result[1];
        }
        return '';
    }

    /**
     * Our function called via Twig; 
     *
     * @param null $url
     *
     * @return string
     */
    public function getVimeoId($url = null)
    {
        if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/?(showcase\/)*([0-9))([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array)) {
            return $output_array[6];
        }
        return '';
    }
}
