<?php
/**
 * Get Video Id plugin for Craft CMS 3.x
 *
 * Twig filter to get the video id of youtube or Vimeo URL.
 *
 * @link      https://github.com/aodihis
 * @copyright Copyright (c) 2021 aodihis
 */

namespace aodihis\videoutils\twigextensions;

use aodihis\videoutils\VideoUtils;

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
class VideoUtilsTwigExtension extends AbstractExtension
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
            new TwigFilter('getVideoId', [$this, 'getVideoId']),
            new TwigFilter('isYoutube', [$this, 'isYoutube']),
            new TwigFilter('isVimeo', [$this, 'isVimeo']),
            new TwigFilter('generateYoutubeEmbedUrl', [$this, 'generateYoutubeEmbedUrl']),
            new TwigFilter('generateVimeoEmbedUrl', [$this, 'generateVimeoEmbedUrl']),
            new TwigFilter('generateVideoEmbedUrl', [$this, 'generateVideoEmbedUrl']),
        ];
    }

    public function getVideoId($url = null) {
        if ($this->isYoutube($url)) {
            return $this->getYoutubeId($url);
        }
        if ($this->isVimeo($url)) {
            return $this->getVimeoId($url);
        }
        return '';
    }

    public function isYoutube($url = null) {
        if(strpos($url, 'youtube.com/') !== false) 
            return true;
        if(strpos($url, 'youtu.be/') !== false)
            return true;
        return false;
    
    }

    public function isVimeo($url = null) {
        if(strpos($url, 'vimeo.com/') !== false)
            return true;
        return false;
    }

    public function getYoutubeId($url = null)
    {
        if (preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $url, $result)){
            return $result[1];
        }
        return '';
    }

    public function getVimeoId($url = null)
    {
        if(preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/?(showcase\/)*([0-9))([a-z]*\/)*([0-9]{6,11})[?]?.*/", $url, $output_array)) {
            return $output_array[6];
        }
        return '';
    }

    public function generateYoutubeEmbedUrl($url = null, $noCookie=false)
    {
        if ($noCookie) {
            return 'https://www.youtube-nocookie.com/embed/'.$this->getYoutubeId($url);
        }
        return 'https://www.youtube.com/embed/'.$this->getYoutubeId($url);
    }

    public function generateVimeoEmbedUrl($url = null, $noCookie=false)
    {
        return 'https://player.vimeo.com/video/'.$this->getVimeoId($url) . $noCookie ?: '?dnt=1';
    }

    public function generateVideoEmbedUrl($url = null, $noCookie=false)
    {
        if ($this->isYoutube($url)) {
            return $this->generateYoutubeEmbedUrl($url, $noCookie);
        }
        if ($this->isVimeo($url)) {
            return $this->generateVimeoEmbedUrl($url, $noCookie);
        }
        return '';
    }
}
