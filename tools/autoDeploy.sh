#!/bin/bash
export TARGET_SERVER1=l.pinchshopper.jp
export PEMPATH=/Users/Naoto/.ssh/chrp_l
export SRCPATH=/Users/Naoto/git/pinchshopper
export DESTPATH=/usr/local/src/pinchshopper

cd ${SRCPATH}
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/* vagrant@${TARGET_SERVER1}:${DESTPATH}/

ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s ln -s ${DESTPATH}/common/ ${DESTPATH}/api/common"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/cache/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_cache/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_compile/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s chmod -R 777 ${DESTPATH}/"