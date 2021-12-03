FROM ruby:2.6.5

RUN apt-get update && \
    apt-get install -y nodejs && \
    git clone git://github.com/doorkeeper-gem/doorkeeper-provider-app.git /app && \
    cd /app && \
    gem install bundler:2.1.4 && \
    bundle install && \
    sed -i s'!https://doorkeeper-sinatra.herokuapp.com/callback!http://localhost/!' db/seeds.rb && \
    bundle exec rake db:setup | tail -n4 > public/secrets.txt

EXPOSE 3000

WORKDIR /app
ENTRYPOINT ["rails", "server", "--binding=0.0.0.0"]




