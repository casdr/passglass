#!/usr/bin/env bash
BASE_URL=$1
TOKEN=$2

CHCK=`curl --silent --insecure --header "Authorization: Bearer ${TOKEN}" -X GET ${BASE_URL}/monitoring/nagios`

echo $CHCK

if [[ "$CHCK" == "all sealed" ]]; then
	exit 0
fi
exit 2
