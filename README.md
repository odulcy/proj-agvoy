# Useful commands

Launch the web page:

`php -S "[::0]":8000 -t public`

Show the available routes:

`bin/console debug:router`

To show the available apps

`bin/console list app`

To check the database, you can use sqlite :
`sqlite3 fichier.sqlite CMD_SQL` 

To load the Data (thanks to the module Data Fixtures) :
`bin/console doctrine:fixture:load`

Original Code is available at :
https://gitlab.com/olberger/tspcsc4101-agvoy-skeleton

To get the original Code, use :
 $ composer create-project oberger/tspcsc4101-agvoy-skeleton agvoy-app

A project created by Nathanel DENIS and Olivier DULCY, based on Olivier BERGER's
work.
