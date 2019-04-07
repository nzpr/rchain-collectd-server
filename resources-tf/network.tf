data "google_compute_network" "default_network" {
  name = "default"
}

resource "google_compute_firewall" "fw_collectd" {
  name = "collectd"
  network = "${data.google_compute_network.default_network.self_link}"
  priority = 510
  source_tags = [ "collectd-out" ]
  target_tags = [ "collectd-in" ]
  allow {
    protocol = "tcp"
    ports = [ 25826 ]
  }
}
