
FROM node

ENV HOME=/usr/src/app
RUN mkdir $HOME
WORKDIR $HOME

USER root

RUN yarn global add @angular/cli npm

RUN yarn install

EXPOSE 4200
EXPOSE 49153

CMD ng serve --host 0.0.0.0
