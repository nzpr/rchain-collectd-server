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

resource "google_dns_record_set" "nginx_vhost_domain" {
  name = "collectd.rchain-dev.tk."
  managed_zone = "rchain-dev"
  type = "CNAME"
  ttl = 300
  rrdatas = ["build.rchain-dev.tk."]
}
