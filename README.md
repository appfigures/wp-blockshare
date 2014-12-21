# WP BlockShare

A simple Wordpress plugin that adds tweet and like buttons to `<blockquote>` elements with the content as the tweet/like message.

// TODO: add image of example (what it looks like on the blog + what the popup looks like)

## Using the plugin

BlockShare will append sharing buttons to every `<blockquote>` element when activated. If you want your tweets to mention you, add your Twitter handle in the plugin's admin settings page.

That should be it. If you want to customize the plugin's behavior and/or look read on.

## Custom block patterns

Out of the box, BlockShare appends tweet and like buttons to every `<blockquote>` element. To apply BlockShare to a different type of element create a custom pattern in the plugin's admin page.

Custom patterns require two things: an _opener_ tag and a _closer_ tag. 

Example:

* Opener: `<h2>`
* Closer: `</h2>`

## Custom CSS

By default, the plugin uses a simple stylesheet to display the tweet and like buttons. You can turn prevent the built-in stylesheet from being included inside the admin settings page and supply your own styles. 

The plugin generates the following elements:

```
<span class="blockshare">
  <a href="..."><span class="icon-twitter"></span></a>
</span>
```

----

Feel free to use this plugin as you see fit wherever you feel like it'll do some good. If you run into any issues or have any suggestions for improvement please open an issue or try to fix and submit a pull request.


