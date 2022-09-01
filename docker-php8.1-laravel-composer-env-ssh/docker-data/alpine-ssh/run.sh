#!/bin/bash
source ~/.bashrc

touch /run/openrc/softlevel

rc-update
rc-status

/etc/init.d/sshd start

tail -f /dev/null
