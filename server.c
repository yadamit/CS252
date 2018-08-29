/* credit @Daniel Scocco */

/****************** SERVER CODE ****************/

#include <stdio.h>
#include<stdlib.h>
#include <netinet/in.h>
#include <string.h>
#include <sys/socket.h>
#include <arpa/inet.h>


int main(){
  int welcomeSocket, newSocket;
  
  struct sockaddr_in serverAddr;
  struct sockaddr_storage serverStorage;
  socklen_t addr_size;

  /*---- Create the socket. The three arguments are: ----*/
  /* 1) Internet domain 2) Stream socket 3) Default protocol (TCP in this case) */
  welcomeSocket = socket(PF_INET, SOCK_STREAM, 0);

  /*---- Configure settings of the server address struct ----*/
  /* Address family = Internet */
  serverAddr.sin_family = AF_INET;
  /* Set port number, using htons function to use proper byte order */
  serverAddr.sin_port = htons(10000);
  /* Set IP address to localhost */
  serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");
  /* Set all bits of the padding field to 0 */
  memset(serverAddr.sin_zero, '\0', sizeof serverAddr.sin_zero);

  /*---- Bind the address struct to the socket ----*/
  bind(welcomeSocket, (struct sockaddr *) &serverAddr, sizeof(serverAddr));

  /*---- Listen on the socket, with 5 max connection requests queued ----*/
  if(listen(welcomeSocket,5)==0)
    printf("I'm listening\n");
  else
    printf("Error\n");

  /*---- Accept call creates a new socket for the incoming connection ----*/
  addr_size = sizeof serverStorage;
  newSocket = accept(welcomeSocket, (struct sockaddr *) &serverStorage, &addr_size);

  /*---- Send message to the socket of the incoming connection ----*/
	// while(1){
	// 	char * str;
 //    str = malloc(1024);
	// 	scanf("%s", str);
 //    int n=strlen(str);
 //  		// strcpy(buffer,str);
 //      printf("%s\n len=%d", str,n);
 //  		send(newSocket,str,n,0);
 //      free(str);
	// }

  int n=0;
  printf("Recieving number of files:\n");
  recv(newSocket, &n, sizeof(n), 0);

  int i=0;
  char file_name[n][100];
  for(i=0;i<n;i++){
    printf("Recieving file_name %d\n",i);
    recv(newSocket, file_name[i], 100, 0);
    printf("files: %s\n", file_name[i]);
  }
  
  
  for(i=0;i<n;i++){
    FILE *file = fopen(file_name[i], "r");
    fseek(file, 0, SEEK_END);
    int f_length = ftell(file);

    char buffer[f_length];

    rewind(file);

    fread(buffer, f_length, 1, file);
    printf("size=%d\n",f_length);

    printf("Sending file size:\n");
    send(newSocket, &f_length, sizeof(f_length), 0);

    // buffer[f_length] = '\0';
    // printf("%s\n", buffer);
    int sent=0;
    printf("Sending file:\n");
    sent = send(newSocket, buffer, f_length, 0);
    printf("Sent file of size %d\n", sent);
  }
  return 0;
}
