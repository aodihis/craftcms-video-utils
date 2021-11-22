# Get Video Id plugin for Craft CMS 3.x

Twig filter to get the video id of youtube or Vimeo URL.

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require aodihis/get-video-id

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Get Video Id.

## Using Get Video Id

```html
{{ "your youtube video url"|getYoutubeId }}
{{ "your Vimeo video url"|getVimeoId }}
```
