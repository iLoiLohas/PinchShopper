#!/bin/bash
#### attention ####
# 最後にconfigの書き直しをする（stgと本番）
###################
export TARGET_SERVER1=l.pinchshopper.jp
export PEMPATH=/Users/Naoto/.ssh/chrp_l
export SRCPATH=/Users/Naoto/git/PinchShopper
export DESTPATH=/usr/local/src/pinchshopper

cd ${SRCPATH}
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/api vagrant@${TARGET_SERVER1}:${DESTPATH}/
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/application vagrant@${TARGET_SERVER1}:${DESTPATH}/ 
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/library vagrant@${TARGET_SERVER1}:${DESTPATH}/    
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/templates vagrant@${TARGET_SERVER1}:${DESTPATH}/    
rsync -rlptvu -e "ssh -i ${PEMPATH}" --delete ${SRCPATH}/src/data vagrant@${TARGET_SERVER1}:${DESTPATH}/    

ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/cache/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_cache/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s rm -fr ${DESTPATH}/data/tmp/smarty_compile/*"
ssh -i ${PEMPATH} vagrant@${TARGET_SERVER1} "sudo -s chmod -R 777 ${DESTPATH}/"
