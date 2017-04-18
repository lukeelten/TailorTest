FROM golang:alpine

WORKDIR /app

EXPOSE 9090

RUN apk update && apk add git
RUN rm -rf ws && mkdir ws && cd ws && export GOPATH=$(pwd) && export PATH=$PATH:$GOPATH/bin && go get github.com/zalando/skipper/...

CMD ["/app/ws/bin/skipper", "-routes-file", "/routes/default.eskip"]