# Wordpress OAI PMH Plugin

This repo is a developpement starter kit for whoever would like to develop its own WordPress OAI-PMH Plugin. It is based on our own implementation of the protocol (Rennes 2 University - L'Aire d'U website). Plugin structure is based on WordPress [Plugin Boilerplate][df1]. The plugin will not work as is. You have to go through the code and fullfill the blanks to adapt it to your needs and make it work.

### How does it work ?

The plugin contains 2 filters and 1 action :

- 1 filter on 'init' event to handle oaipmh request variables ('verb', 'identifier', etc...)
- 1 action that that create a rewrite rule handling '/oai?verb=...' requests and redirecting them to '/index.php?wpoaipmh=true&verb=...'
- 1 filter on 'include_template' to identify on oai-pmh request (based on presence of 'wpaoipmh' var in request) and redirect to our own template to handle the request

After activating (and deactivating) the plugin, one should SAVE the PERMALINKS so that our new rule is taken into account (or removed).

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [df1]: <https://github.com/DevinVinson/WordPress-Plugin-Boilerplate>

