# WP Rest API Allow Drafts

This plugin allows draft posts and pages to come through into WP Rest Api when requesting for single draft posts and pages by id when the referrer host name matches the home url:

```
fetch('/wp-json/wp/v2/pages/250')
fetch('/wp-json/wp/v2/posts/250')
```

Browsers automatically send a `referrer` header when any request is made from the browser, so as long as you are making the request from the same domain as where Wordpress is hosted it will work.

## Caveats

If you need to make requests for draft posts and pages where the `referrer` does not match, such as a subdomain, you can always fork this plugin and customise to allow and hard code the url(s) you need.

If you need to make requests for draft posts and pages from a server where a `referrer` is not sent, you could always fork this plugin and customise but i recommend just sending Basic authentication header with an admin username:password from Wordpress since server requests are not exposed like client and browser requests are.
