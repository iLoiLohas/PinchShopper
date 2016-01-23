#!/bin/bash
export TARGET_SERVER1=52.2.141.45
export PEMPATH=~/git/pem/placealbum.pem
export SRCPATH=~/git/pinchshopper
export DESTPATH=/usr/local/src/pinchshopper

cd ${SRCPATH}
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/* ec2-user@${TARGET_SERVER1}:${DESTPATH}/

ssh -i ${PEMPATH} ec2-user@${TARGET_SERVER1} "sudo -s ln -s ${DESTPATH}/common/ ${DESTPATH}/api/common"
ssh -i ${PEMPATH} ec2-user@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/cache/*"
ssh -i ${PEMPATH} ec2-user@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_cache/*"
ssh -i ${PEMPATH} ec2-user@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_compile/*"
ssh -i ${PEMPATH} ec2-user@${TARGET_SERVER1} "sudo -s chmod -R 777 ${DESTPATH}/"