<?php
$CONFIG['showload'] = true;
$CONFIG['showmem'] = true;
$CONFIG['showtime'] = true;

$CONFIG['graph_type'] = 'hybrid';
$CONFIG['graph_smooth'] = true;
$CONFIG['graph_minmax'] = false;

$CONFIG['width'] = 700;
$CONFIG['height'] = 300;
$CONFIG['detail-width'] = 1000;
$CONFIG['detail-height'] = 500;

$CONFIG['cat']['testnet'] = '/^node\d+\.testnet\.rchain-dev\.tk$/';
$CONFIG['cat']['devnet'] = '/^node\d+\.devnet\.rchain-dev\.tk$/';

$CONFIG['term'] = array(
	'1 hour'   => 3600 * 1,
	'2 hours'  => 3600 * 2,
	'4 hours'  => 3600 * 4,
	'12 hours' => 3600 * 12,
	'1 day'    => 86400,
	'2 days'   => 86400 * 2,
	'3 days'   => 86400 * 4,
	'week'     => 86400 * 7,
	'2 weeks'  => 86400 * 14,
	'month'    => 86400 * 31,
	'quarter'  => 86400 * 31 * 3,
	'year'     => 86400 * 365,
);

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
