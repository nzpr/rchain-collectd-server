<?php
$CONFIG['cat']['testnet'] = '/^node\d+\.testnet\.rchain-dev\.tk$/';

$CONFIG['overview'] = array(
	'load',
	'memory',
	'cpu',
	'contextswitch',
	'fhcount',
	'processes',
	'interface',
	'tcpconns',
	'ping',
	'disk',
	'df',
);

$CONFIG['overview_filter_fn'] = function ($item) {
	if ($item['p'] == 'interface' && preg_match('/^if_(dropped|errors)$/', $item['t']))
		return false;
	if ($item['p'] == 'cpu' && !preg_match('/^\d+$/', $item['pi']))
		return false;
	if ($item['p'] == 'ping' && $item['t'] !== 'ping')
		return false;
	if ($item['p'] == 'processes' && !preg_match('/^ps_(count|cputime)$/', $item['t']))
		return false;
	if ($item['p'] == 'tcpconns' && $item['pi'] !== 'all')
		return false;
	if ($item['p'] == 'disk' && !preg_match('/^disk_(io_time|octets)$/', $item['t']))
		return false;
	return true;
};

$CONFIG['showload'] = true;
$CONFIG['showmem'] = true;
$CONFIG['showtime'] = true;
$CONFIG['graph_type'] = 'hybrid';
$CONFIG['graph_smooth'] = true;
$CONFIG['graph_minmax'] = false;
$CONFIG['width'] = 700;
$CONFIG['height'] = 300;
