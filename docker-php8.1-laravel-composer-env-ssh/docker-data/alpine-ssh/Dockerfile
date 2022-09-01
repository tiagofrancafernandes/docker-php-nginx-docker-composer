FROM alpine

USER 'root'

WORKDIR /var/www

ARG APP_VER
ENV APP_VER=${APP_VER:-beta_02}

RUN sh -c "echo ${APP_VER}"

RUN apk update

RUN apk add git wget curl zip unzip nano bash zsh

## https://wiki.alpinelinux.org/wiki/Change_default_shell
RUN apk add libuser sudo shadow

RUN addgroup sudo

RUN touch /etc/login.defs && mkdir /etc/default && touch /etc/default/useradd

ENV USER="root"
## Some changes on root user
RUN usermod -aG sudo "${USER}" && \
    usermod  --password "" "${USER}" && \
    usermod --shell /bin/zsh $USER && \
    usermod --shell /bin/zsh root && \
    echo "$USER ALL=(ALL) NOPASSWD:ALL" > /etc/sudoers.d/$USER && chmod 0440 /etc/sudoers.d/$USER

## root user
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"


## ALIASES
ENV ALIASES="alias nano='nano -$ -T 4 -l -e -A --positionlog --tabstospaces --trimblanks'"
ENV ALIASES="${ALIASES}\nalias ls='ls --color=auto'"
ENV ALIASES="${ALIASES}\nalias las='ls -lah'"
RUN echo -e "$ALIASES" >> ~/aliases
RUN echo 'if [ -f ~/aliases ]; then source ~/aliases; fi' >> ~/.bashrc
RUN echo 'if [ -f ~/aliases ]; then source ~/aliases; fi' >> ~/.zshrc
## END ALIASES

RUN curl -o ~/git-ps1-pure.sh https://gist.githubusercontent.com/tiagofrancafernandes/0ddbed3f8f30bf2aeb9f211a6d468636/raw/git-ps1-pure.sh && \
echo 'if [ -f ~/git-ps1-pure.sh ]; then source ~/git-ps1-pure.sh; fi' >> ~/.bashrc && source ~/.bashrc

## SSH server

RUN mkdir /app

RUN apk add openssh openrc

RUN rc-update

RUN rc-status

RUN touch /run/openrc/softlevel

COPY run.sh /app/run.sh

RUN chmod +x /app/run.sh

#RUN apk add php-fpm

EXPOSE 22

CMD ["/etc/init.d/sshd", "start"]
#CMD ["sh -c '/etc/init.d/sshd start']

#ENTRYPOINT ["/app/run.sh"]
CMD ["/app/run.sh"]
#CMD ["php-fpm"]
