from __future__ import print_function

import collectd
import requests

status_conv = {
    collectd.NOTIF_OKAY: 0,
    collectd.NOTIF_WARNING: 1,
    collectd.NOTIF_FAILURE: 2
}

url = 'http://nagios.c.developer-222401.internal:6315/submit_result'


def handle_notification(notif):
    requests.post(
        url,
        json={
            'host':
                notif.host,
            'service':
                '{}-{}/{}-{}'.format(
                    notif.plugin,
                    notif.plugin_instance,
                    notif.type,
                    notif.type_instance,
                ),
            'status':
                status_conv[notif.severity],
            'output':
                notif.message
        }
    ).raise_for_status()


collectd.register_notification(handle_notification)
