FROM gcc:5.4.0
WORKDIR /add the path/
COPY . .
EXPOSE 1001
RUN gcc -o server server.c
ENV PATH /add the path/:$PATH
ENTRYPOINT ["server", "1001"]
