FROM jekyll/jekyll:4.2.2

ENV BUNDLER_VERSION=2.3.13

COPY . /srv/jekyll

WORKDIR /srv/jekyll
RUN bundle config set --local path '/srv/jekyll/.bundle'
