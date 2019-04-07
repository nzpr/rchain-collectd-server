data "google_compute_address" "nginx_addr" {
  name = "build"
  region = "us-east1"
}

resource "google_dns_record_set" "nginx_vhost_domain" {
  name = "collectd.rchain-dev.tk."
  managed_zone = "rchain-dev"
  type = "CNAME"
  ttl = 300
  rrdatas = ["${data.google_compute_address.nginx_addr.*.address[count.index]}"]
}
