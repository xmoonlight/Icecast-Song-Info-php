# Icecast-Song-Info-php
Retrieve info about song from server status page (PHP-class)

## USAGE:
```
$icecast=new IcecastSongInfo();

1. FETCH PAGE:
$icecast->fetch('http://your-Icecast-server.com/status.xsl'[,'proxy.com:port']);

2. QUERY SELECT:
$icecast->select('search-string-in-ALL-mount-points'[,'needed-param-substring'[,'mount-point-name']]);
```

### needed-param-substring (string or substring, case insensitive):
* Stream Title
* Stream Description
* Content Type
* Mount started
* Bitrate
* Current Listeners
* Peak Listeners
* Stream Genre
* Stream URL
* Current Song
* ...


## EXAMPLE:
```php
$icecast=new IcecastSongInfo();
if ($icecast->fetch('http://your-icecast-domain.com/status.xsl','proxy-site.com:port'))
	foreach ($icecast->select('MY RADIO','song','/128.mp3') as $i){
		 echo $i.'<br/>';
	}
else echo 'Fetching ERROR: '.$icecast->error();
```
