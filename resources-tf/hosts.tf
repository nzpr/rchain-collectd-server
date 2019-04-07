resource "google_compute_instance" "node_host" {
  name = "collectd-server"
  machine_type = "n1-standard-1"

  boot_disk {
    initialize_params {
      image = "ubuntu-os-cloud/ubuntu-1810"
      size = 80
      type = "pd-standard"
    }
  }

  tags = [
    "collectd-in"
  ]

  network_interface {
    network = "${data.google_compute_network.default_network.self_link}"
    access_config {}
  }

  connection {
    type = "ssh"
    user = "root"
    private_key = "${file("~/.ssh/google_compute_engine")}"
  }

  provisioner "file" {
    source = "${var.rchain_sre_git_crypt_key_file}"
    destination = "/root/rchain-sre-git-crypt-key"
  }

  provisioner "remote-exec" {
    script = "../bootstrap"
  }
}
