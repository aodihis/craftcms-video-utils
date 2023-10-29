# Get Video Id plugin for Craft CMS 4.x

Twig filter to get the video id of youtube or Vimeo URL.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require aodihis/video-utils

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Get Video Id.

## Using Vide Utils

To check url is vimeo or youtube.
```html
{{ "url"|isYoutube}}
{{ "url"|isVimeo}}
```

To get the video id from the url.
```html
{{ "your youtube video url"|getYoutubeId }}
{{ "your Vimeo video url"|getVimeoId }}
```
Also you can do this:

```html
{{ "url"|getVideoId }}
```
To generate the embed video url from your video id :

```html
{ "your youtube video url"|generateYoutubeEmbedUrl }}
{{ "your Vimeo video url"|generateVimeoEmbedUrl }}
```

Also you can do this : 

{{ "url"|generateVideoEmbedUrl }}

if you wanted to get the embedded video with the no cookie :

```
{{ "url"|generateVideoEmbedUrl('no-cookie') }}
{ "your youtube video url"|generateYoutubeEmbedUrl('no-cookie') }}
{{ "your Vimeo video url"|generateVimeoEmbedUrl('no-cookie') }}
```
